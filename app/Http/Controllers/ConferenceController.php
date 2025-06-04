<?php

namespace App\Http\Controllers;

use App\Http\Requests\Conference\ConferenceIdValidationRequest;
use App\Http\Requests\Conference\CreateConferenceRequest;
use App\Http\Requests\Conference\EditConferenceRequest;
use App\Models\Conference;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ConferenceController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        try {
            $conferences = Conference::select([
                'id',
                'title',
                'date',
            ]);

            if ($request->filled('search')) {
                $search = $request->input('search');
                $conferences->where('title', 'like', '%'.$search.'%');
            }

            if ($request->filled('status')) {
                $status = $request->input('status');
                if ($status === 'upcoming') {
                    $conferences->where('date', '>=', now());
                } elseif ($status === 'past') {
                    $conferences->where('date', '<', now());
                }
            }

            if ($request->filled('order_by')) {
                match ($request->input('order_by')) {
                    'title_asc' => $conferences->orderBy('title', 'asc'),
                    'title_desc' => $conferences->orderBy('title', 'desc'),
                    'oldest' => $conferences->orderBy('date', 'asc'),
                    default => $conferences->orderBy('date', 'desc'),
                };
            } else {
                $conferences->orderBy('date', 'desc');
            }

            $conferences = $conferences->paginate(5);

            $conferences->appends($request->query());

            return view('Conference.index', ['conferences' => $conferences]);
        } catch (Exception $e) {
            Log::error('Error fetching conferences: '.$e->getMessage());

            return view('errors.custom-error', ['message' => 'Nuk mund të merreshin konferencat.']);
        }
    }

    public function create(): View
    {
        return view('Conference.create');
    }

    public function store(CreateConferenceRequest $request): View|RedirectResponse
    {
        try {
            $validated = $request->only(['title', 'date']);

            Conference::create($validated);

            return redirect()->route('conference.index')
                ->with('success', 'Konferenca u krijua me sukses!');
        } catch (Exception $e) {
            Log::error('Error storing conference: '.$e->getMessage());

            return view('errors.custom-error', ['message' => 'Nuk mund të krijohej konferenca.']);
        }
    }

    public function edit(ConferenceIdValidationRequest $request): View|RedirectResponse
    {
        try {
            $validated = $request->only('id');

            $conference = Conference::select(['id', 'title', 'date'])
                ->findOrFail($validated['id']);

            return view('Conference.edit', ['conference' => $conference]);
        } catch (ModelNotFoundException $e) {
            Log::warning('Conference not found for editing: '.$e->getMessage());

            return view('errors.custom-error', ['message' => 'Konferenca nuk u gjet për përditësim.']);
        } catch (Exception $e) {
            Log::error('Error retrieving conference for editing: '.$e->getMessage());

            return view('errors.custom-error', ['message' => 'Nuk mund të merrej konferenca për përditësim.']);
        }
    }

    public function update(EditConferenceRequest $request): View|RedirectResponse
    {
        try {
            $validated = $request->only(['id', 'title', 'date']);

            $conference = Conference::findOrFail($validated['id']);

            $conference->update($validated);

            return redirect()->route('conference.index')
                ->with('success', 'Konferenca u përditësua me sukses!');
        } catch (ModelNotFoundException $e) {
            Log::warning('Conference not found for update: '.$e->getMessage());

            return view('errors.custom-error', ['message' => 'Konferenca nuk u gjet për përditësim.']);
        } catch (Exception $e) {
            Log::error('Error updating conference: '.$e->getMessage());

            return view('errors.custom-error', ['message' => 'Nuk mund të përditësohej konferenca.']);
        }
    }

    /* TODO- PYETE SHASIVARIN A KA NEVOJ PER FSHIRJEN E KONFERENCAVE, NESE ATEHERE DUHEN TE FSHIN NE MENYRE AUTOMATIKE EDHE DOKUMENTETE E ASAJ KONFERENCE */
    public function destroy(ConferenceIdValidationRequest $request): View|RedirectResponse
    {
        try {
            $validated = $request->only('id');

            $conference = Conference::findOrFail($validated['id']);
            $conference->delete();

            return redirect()->route('conference.index')
                ->with('success', 'Konferenca u fshi me sukses!');
        } catch (ModelNotFoundException $e) {
            Log::warning('Conference not found for deletion: '.$e->getMessage());

            return view('errors.custom-error', ['message' => 'Konferenca nuk u gjet për fshirje.']);
        } catch (Exception $e) {
            Log::error('Error deleting conference: '.$e->getMessage());

            return view('errors.custom-error', ['message' => 'Nuk mund të fshihej konferenca.']);
        }
    }
}
