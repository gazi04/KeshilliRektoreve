<?php

namespace App\Http\Controllers;

use App\Http\Requests\Document\CreateDocumentRequest;
use App\Http\Requests\Document\DocumentIdValidationRequest;
use App\Http\Requests\Document\EditDocumentRequest;
use App\Models\Conference;
use App\Models\Document;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class DocumentController extends Controller
{
    public function index(Request $request): View
    {
        $documents = Document::with('conference');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $documents->where('title', 'like', '%'.$search.'%');
        }

        if ($request->filled('order_by')) {
            match ($request->input('order_by')) {
                'title_asc' => $documents->orderBy('title', 'asc'),
                'title_desc' => $documents->orderBy('title', 'desc'),
                'oldest' => $documents->orderBy('created_at', 'asc'),
                default => $documents->orderBy('created_at', 'desc'),
            };
        } else {
            $documents->orderBy('created_at', 'desc');
        }

        $documents = $documents->paginate(10);

        $documents->appends($request->query());

        return view('Document.index', ['documents' => $documents]);
    }

    public function create(): View
    {
        $conferences = Conference::orderBy('date', 'desc')->get();

        return view('Document.create', ['conferences' => $conferences]);
    }

    public function store(CreateDocumentRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        if ($request->hasFile('url')) {
            $file = $request->file('url');
            $filePath = Storage::disk('private_documents')->putFile('documents', $file);
            $validatedData['url'] = $filePath;
        }

        Document::create($validatedData);

        return redirect()->route('document.index')->with('success', 'Dokumenti u krijua me sukses!');
    }

    public function edit(DocumentIdValidationRequest $request): View
    {
        $document = Document::with('conference')->findOrFail($request->input('id'));
        $conferences = Conference::orderBy('date', 'desc')->get();

        return view('Document.edit', ['document' => $document, 'conferences' => $conferences]);
    }

    public function update(EditDocumentRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        $document = Document::findOrFail($validatedData['id']);

        if ($request->hasFile('url')) {
            if ($document->url && Storage::disk('private_documents')->exists($document->url)) {
                Storage::disk('private_documents')->delete($document->url);
            }

            $file = $request->file('url');
            $filePath = Storage::disk('private_documents')->putFile('documents', $file);
            $validatedData['url'] = $filePath;
        } else {
            unset($validatedData['url']);
        }

        $document->update($validatedData);

        return redirect()->route('document.index')->with('success', 'Dokumenti u përditësua me sukses!');
    }

    public function destroy(DocumentIdValidationRequest $request): RedirectResponse
    {
        $document = Document::findOrFail($request->input('id'));

        if ($document->url && Storage::disk('private_documents')->exists($document->url)) {
            Storage::disk('private_documents')->delete($document->url);
        }

        $document->delete();

        return redirect()->route('document.index')->with('success', 'Dokumenti u fshi me sukses!');
    }

    public function download(DocumentIdValidationRequest $request)
    {
        $document = Document::findOrFail($request->input('id'));

        if (Storage::disk('private_documents')->exists($document->url)) {
            return Storage::disk('private_documents')->download($document->url, 'document');
        }

        return back()->with('error', 'Skedari i dokumentit nuk u gjet.');
    }
}
