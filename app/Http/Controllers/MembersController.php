<?php

namespace App\Http\Controllers;
use App\Models\Members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MembersController extends Controller
{
    public function index()
    {
        $members = Members::orderBy('orderNr', 'asc')->paginate(10);
        return view('members.index', compact('members'));
    }

    public function create()
    {
        $nextOrder = Members::max('orderNr') + 1;
        return view('members.createMember', compact('nextOrder'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:50',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'orderNr' => 'required|integer|min:1|unique:members,orderNr',
            'imageUrl' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('imageUrl')) {
            $imagePath = $request->file('imageUrl')->store('members', 'public');
            $validated['imageUrl'] = $imagePath;
        }

        Members::create([
            'title' => $request->title,
            'name' => $request->name,
            'position' => $request->position,
            'email' => $request->email,
            'orderNr' => $request->orderNr,
            'imageUrl' => $imagePath ?? null,
        ]);

        return redirect()->route('members.index')
            ->with('success', 'Anëtari u krijua me sukses!');


    }

    public function show(Members $member)
    {
        return view('members.showMembers', compact('member'));
    }

    public function edit(Members $member)
    {
        return view('members.editMember', compact('member'));
    }

    public function update(Request $request, Members $member)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:50',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'orderNr' => 'required|integer|min:1|unique:members,orderNr,' . $member->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($member->imageUrl);

            $validated['imageUrl'] = $request->file('image')->store('members', 'public');
        }

        $member->update($validated);
        return redirect()->route('members.index')->with('success', 'Member updated!');
    }

    public function destroy(Members $member)
    {
        Storage::disk('public')->delete($member->imageUrl);

        $member->delete();
        return redirect()->route('members.index')->with('success', 'Member deleted!');
    }
}