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
    /**
     * Display a listing of the conferences.
     *
     * @param Request $request
     * @return View|RedirectResponse
     */
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

            // In case of an error on the index page, we might not want to redirect,
            // but rather show an error message on the page or a blank page with an error.
            // For the purpose of this request, adhering to the redirect requirement:
            return redirect()->route('conference.index')->with('error', 'Could not retrieve conferences: '.$e->getMessage());
        }
    }

    public function create(): View
    {
        return view('Conference.create');
    }

    public function store(CreateConferenceRequest $request): RedirectResponse
    {
        try {
            $validated = $request->only(['title', 'date']);

            Conference::create($validated);

            return redirect()->route('conference.index')
                ->with('success', 'Konferenca u krijua me sukses!');
        } catch (Exception $e) {
            Log::error('Error storing conference: '.$e->getMessage());

            return redirect()->route('conference.index')->with('error', 'Could not create conference: '.$e->getMessage());
        }
    }

    public function edit(ConferenceIdValidationRequest $request): View|RedirectResponse
    {
        try {
            $validated = $request->only('id');

            // Using findOrFail for better error handling if the ID does not exist
            $conference = Conference::select(['id', 'title', 'date'])
                ->findOrFail($validated['id']);

            return view('Conference.edit', ['conference' => $conference]);
        } catch (ModelNotFoundException $e) {
            Log::warning('Conference not found for editing: '.$e->getMessage());

            return redirect()->route('conference.index')->with('error', 'Conference not found.');
        } catch (Exception $e) {
            Log::error('Error retrieving conference for editing: '.$e->getMessage());

            return redirect()->route('conference.index')->with('error', 'Could not retrieve conference for editing: '.$e->getMessage());
        }
    }

    public function update(EditConferenceRequest $request): RedirectResponse
    {
        try {
            $validated = $request->only(['id', 'title', 'date']);

            // Using findOrFail for better error handling if the ID does not exist
            $conference = Conference::findOrFail($validated['id']);

            $conference->update($validated);

            return redirect()->route('conference.index')
                ->with('success', 'Konferenca u përditësua me sukses!');
        } catch (ModelNotFoundException $e) {
            Log::warning('Conference not found for update: '.$e->getMessage());

            return redirect()->route('conference.index')->with('error', 'Conference not found.');
        } catch (Exception $e) {
            Log::error('Error updating conference: '.$e->getMessage());

            return redirect()->route('conference.index')->with('error', 'Could not update conference: '.$e->getMessage());
        }
    }

    /* TODO- PYETE SHASIVARIN A KA NEVOJ PER FSHIRJEN E KONFERENCAVE, NESE ATEHERE DUHEN TE FSHIN NE MENYRE AUTOMATIKE EDHE DOKUMENTETE E ASAJ KONFERENCE */
    public function destroy(ConferenceIdValidationRequest $request): RedirectResponse
    {
        try {
            $validated = $request->only('id');

            $conference = Conference::findOrFail($validated['id']);
            $conference->delete();

            return redirect()->route('conference.index')
                ->with('success', 'Konferenca u fshi me sukses!');
        } catch (ModelNotFoundException $e) {
            Log::warning('Conference not found for deletion: '.$e->getMessage());

            return redirect()->route('conference.index')->with('error', 'Conference not found.');
        } catch (Exception $e) {
            Log::error('Error deleting conference: '.$e->getMessage());

            return redirect()->route('conference.index')->with('error', 'Could not delete conference: '.$e->getMessage());
        }
    }
}
