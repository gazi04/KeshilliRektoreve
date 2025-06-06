<?php

namespace App\Http\Controllers;

use App\Http\Requests\Document\CreateDocumentRequest;
use App\Http\Requests\Document\DocumentIdValidationRequest;
use App\Http\Requests\Document\EditDocumentRequest;
use App\Models\Conference;
use App\Models\Document;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DocumentController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        try {
            $documents = Document::with('conference');

            if ($request->filled('search')) {
                $search = $request->input('search');
                $documents->where('title', 'like', '%'.$search.'%')
                    ->orWhere('type', 'like', '%'.$search.'%')
                    ->orWhereHas('conference', function ($query) use ($search) {
                        $query->where('title', 'like', '%'.$search.'%');
                    });
            }

            if ($request->filled('order_by')) {
                match ($request->input('order_by')) {
                    'title_asc' => $documents->orderBy('title', 'asc'),
                    'title_desc' => $documents->orderBy('title', 'desc'),
                    'type_asc' => $documents->orderBy('type', 'asc'),
                    'type_desc' => $documents->orderBy('type', 'desc'),
                    'oldest' => $documents->orderBy('created_at', 'asc'),
                    default => $documents->orderBy('created_at', 'desc'),
                };
            } else {
                $documents->orderBy('created_at', 'desc');
            }

            $documents = $documents->paginate(10);

            $documents->appends($request->query());

            return view('Document.index', ['documents' => $documents]);
        } catch (Exception $e) {
            Log::error('Error fetching documents: '.$e->getMessage());

            return view('errors.custom-error', ['message' => 'Nuk mund të merreshin dokumentet.']);
        }
    }

    public function create(): View|RedirectResponse
    {
        try {
            $conferences = Conference::orderBy('date', 'desc')
                ->where('isActive', true)
                ->get();

            if ($conferences->isEmpty()) {
                return redirect()->route('document.index')->with('error', 'Nuk mund të krijohet një dokument pa konferencat ekzistuese.');
            }

            return view('Document.create', ['conferences' => $conferences]);
        } catch (Exception $e) {
            Log::error('Error preparing document creation form: '.$e->getMessage());

            return view('errors.custom-error', ['message' => 'Nuk mund të ngarkohej formulari i krijimit të dokumentit.']);
        }
    }

    public function store(CreateDocumentRequest $request): View|RedirectResponse
    {
        try {
            $validatedData = $request->validated();

            if ($request->hasFile('url')) {
                $file = $request->file('url');
                $filePath = Storage::disk('private_documents')->putFile('documents', $file);

                throw_unless($filePath, new Exception('Failed to upload document file.'));
                $validatedData['url'] = $filePath;
            }

            Document::create($validatedData);

            return redirect()->route('document.index')->with('success', 'Dokumenti u krijua me sukses!');
        } catch (Exception $e) {
            Log::error('Error storing document: '.$e->getMessage());
            if (isset($filePath) && Storage::disk('private_documents')->exists($filePath)) {
                Storage::disk('private_documents')->delete($filePath);
            }

            return view('errors.custom-error', ['message' => 'Dokumenti nuk mund të krijohej.']);
        }
    }

    public function edit(DocumentIdValidationRequest $request): View|RedirectResponse
    {
        try {
            $document = Document::with('conference')->findOrFail($request->input('id'));
            $conferences = Conference::orderBy('date', 'desc')->get();

            return view('Document.edit', ['document' => $document, 'conferences' => $conferences]);
        } catch (ModelNotFoundException $e) {
            Log::warning('Document not found for editing (ID: '.$request->input('id').'): '.$e->getMessage());

            return view('errors.custom-error', ['message' => 'Dokumenti nuk u gjet.']);
        } catch (Exception $e) {
            Log::error('Error retrieving document for editing (ID: '.$request->input('id').'): '.$e->getMessage());

            return view('errors.custom-error', ['message' => 'Nuk munda ta gjej dokumentin për ta përditësuar.']);
        }
    }

    public function update(EditDocumentRequest $request): View|RedirectResponse
    {
        try {
            $validatedData = $request->validated();

            $document = Document::findOrFail($validatedData['id']);

            if ($request->hasFile('url')) {
                $file = $request->file('url');
                $newFilePath = Storage::disk('private_documents')->putFile('documents', $file);

                throw_unless($newFilePath, new Exception('Failed to upload new document file.'));

                if ($document->url && Storage::disk('private_documents')->exists($document->url)) {
                    Storage::disk('private_documents')->delete($document->url);
                }
                $validatedData['url'] = $newFilePath;
            } else {
                unset($validatedData['url']);
            }

            $document->update($validatedData);

            return redirect()->route('document.index')->with('success', 'Dokumenti u përditësua me sukses!');
        } catch (ModelNotFoundException $e) {
            Log::warning('Document not found for update (ID: '.($validatedData['id'] ?? 'N/A').'): '.$e->getMessage());
            if (isset($newFilePath) && Storage::disk('private_documents')->exists($newFilePath)) {
                Storage::disk('private_documents')->delete($newFilePath);
            }

            return view('errors.custom-error', ['message' => 'Dokumenti nuk u gjet.']);
        } catch (Exception $e) {
            Log::error('Error updating document (ID: '.($validatedData['id'] ?? 'N/A').'): '.$e->getMessage());
            if (isset($newFilePath) && Storage::disk('private_documents')->exists($newFilePath)) {
                Storage::disk('private_documents')->delete($newFilePath);
            }

            return view('errors.custom-error', ['message' => 'Dokumenti nuk mund të përditësohej.']);
        }
    }

    public function destroy(DocumentIdValidationRequest $request): View|RedirectResponse
    {
        try {
            $document = Document::findOrFail($request->input('id'));
            $documentUrl = $document->url;

            $document->delete();

            if ($documentUrl && Storage::disk('private_documents')->exists($documentUrl)) {
                Storage::disk('private_documents')->delete($documentUrl);
            }

            return redirect()->route('document.index')->with('success', 'Dokumenti u fshi me sukses!');
        } catch (ModelNotFoundException $e) {
            Log::warning('Document not found for deletion (ID: '.$request->input('id').'): '.$e->getMessage());

            return view('errors.custom-error', ['message' => 'Dokumenti nuk u gjet.']);
        } catch (Exception $e) {
            Log::error('Error deleting document (ID: '.$request->input('id').'): '.$e->getMessage());

            return view('errors.custom-error', ['message' => 'Dokumenti nuk mund të fshihej.']);
        }
    }

    public function download(DocumentIdValidationRequest $request): StreamedResponse|RedirectResponse|View
    {
        try {
            $document = Document::findOrFail($request->input('id'));

            if (! $document->url) {
                Log::warning('Attempted to download document with no file URL (ID: '.$request->input('id').').');

                return back()->with('error', 'Dokumenti nuk ka një skedar të bashkëngjitur.');
            }

            if (Storage::disk('private_documents')->exists($document->url)) {
                $filename = $document->title.'.'.pathinfo((string) $document->url, PATHINFO_EXTENSION);

                return Storage::disk('private_documents')->download($document->url, $filename);
            }

            Log::warning('Document file not found on disk (URL: '.$document->url.', ID: '.$request->input('id').').');

            return view('errors.custom-error', ['message' => 'Skedari i dokumentit nuk u gjet në server.']);
        } catch (ModelNotFoundException $e) {
            Log::warning('Document not found for download (ID: '.$request->input('id').'): '.$e->getMessage());

            return view('errors.custom-error', ['message' => 'Dokumenti nuk u gjet.']);
        } catch (Exception $e) {
            Log::error('Error during document download (ID: '.$request->input('id').'): '.$e->getMessage());

            return view('errors.custom-error', ['message' => 'Një gabim ndodhi gjatë shkarkimit të dokumentit.']);
        }
    }
}
