<?php

namespace App\Http\Controllers;

use App\Http\Requests\Members\CreateMemberRequest;
use App\Http\Requests\Members\EditMemberRequest;
use App\Models\Members;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Throwable;

class MembersController extends Controller
{
    public function index(Request $request): View
    {
        try {
            $query = Members::query();

            $search = $request->query('search');
            if ($search) {
                $query->where(function ($q) use ($search): void {
                    $q->where('title', 'like', '%'.$search.'%')
                        ->orWhere('name', 'like', '%'.$search.'%')
                        ->orWhere('position', 'like', '%'.$search.'%')
                        ->orWhere('email', 'like', '%'.$search.'%');
                });
            }

            // Default sort by 'orderNr' ascending
            $sortField = $request->query('sort', 'orderNr');
            $sortDirection = $request->query('direction', 'asc');

            // Validate sort field to prevent SQL injection
            $allowedSortFields = ['orderNr', 'name', 'position', 'email', 'title'];
            if (! in_array($sortField, $allowedSortFields)) {
                $sortField = 'orderNr';
            }

            // Validate sort direction
            if (! in_array($sortDirection, ['asc', 'desc'])) {
                $sortDirection = 'asc';
            }

            $query->orderBy($sortField, $sortDirection);

            $members = $query->paginate(10)->withQueryString();

            return view('members.index', ['members' => $members, 'search' => $search, 'sortField' => $sortField, 'sortDirection' => $sortDirection]);
        } catch (Throwable $e) {
            Log::error('Error fetching members index: '.$e->getMessage(), ['exception' => $e]);

            return view('errors.custom-error', ['message' => 'Nuk mund të merreshin anëtarët.']);
        }
    }

    public function create(): View
    {
        try {
            $nextOrder = Members::max('orderNr') + 1;

            return view('members.createMember', ['nextOrder' => $nextOrder]);
        } catch (Throwable $e) {
            Log::error('Error preparing create member form: '.$e->getMessage(), ['exception' => $e]);

            return view('errors.custom-error', ['message' => 'Nuk mund të hapet forma për krijimin e anëtarit.']);
        }
    }

    public function store(CreateMemberRequest $request): View|RedirectResponse
    {
        try {
            $validated = $request->validated();

            if ($request->hasFile('imageUrl')) {
                $imagePath = $request->file('imageUrl')->store('profiles', 'private_members');
                $validated['imageUrl'] = $imagePath;
            }

            Members::create($validated);

            return redirect()->route('members.index')
                ->with('success', 'Anëtari u krijua me sukses!');
        } catch (Throwable $e) {
            Log::error('Error storing member: '.$e->getMessage(), ['exception' => $e, 'request_data' => $request->except('imageUrl')]);

            return view('errors.custom-error', ['message' => 'Nuk mund të krijohej anëtari për shkak të një gabimi të brendshëm.']);
        }
    }

    public function show(Members $member)
    {
        return view('members.showMembers', ['member' => $member]);
    }

    public function edit(Members $member): View
    {
        try {
            return view('members.editMember', ['member' => $member]);
        } catch (Throwable $e) {
            Log::error('Error preparing edit member form: '.$e->getMessage(), ['exception' => $e, 'member_id' => $member->id]);

            return view('errors.custom-error', ['message' => 'Nuk mund të hapet forma për përditësimin e anëtarit.']);
        }
    }

    public function update(EditMemberRequest $request, Members $member): View|RedirectResponse
    {
        try {
            $validated = $request->validated();

            if ($request->hasFile('image')) {
                if ($member->imageUrl && Storage::disk('private_members')->exists($member->imageUrl)) {
                    Storage::disk('private_members')->delete($member->imageUrl);
                }
                $validated['imageUrl'] = $request->file('image')->store('profiles', 'private_members');
            } elseif (isset($validated['image'])) {
                unset($validated['image']);
            }

            $member->update($validated);

            return redirect()->route('members.index')->with('success', 'Anëtari u përditësua me sukses!');
        } catch (Throwable $e) {
            Log::error('Error updating member: '.$e->getMessage(), ['exception' => $e, 'member_id' => $member->id, 'request_data' => $request->except('image')]);

            return view('errors.custom-error', ['message' => 'Nuk mund të përditësohej anëtari për shkak të një gabimi të brendshëm.']);
        }
    }

    public function destroy(Members $member): View|RedirectResponse
    {
        try {
            if ($member->imageUrl && Storage::disk('private_members')->exists($member->imageUrl)) {
                Storage::disk('private_members')->delete($member->imageUrl);
            }

            $member->delete();

            return redirect()->route('members.index')->with('success', 'Anëtari u fshi me sukses!');
        } catch (Throwable $e) {
            Log::error('Error deleting member: '.$e->getMessage(), ['exception' => $e, 'member_id' => $member->id]);

            return view('errors.custom-error', ['message' => 'Nuk mund të fshihej anëtari për shkak të një gabimi të brendshëm.']);
        }
    }

    public function showImage(Members $member)
    {
        if ($member->imageUrl && Storage::disk('private_members')->exists($member->imageUrl)) {
            return Storage::disk('private_members')->response($member->imageUrl);
        }
        return null;
    }
}
