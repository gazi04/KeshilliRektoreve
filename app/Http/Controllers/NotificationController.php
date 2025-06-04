<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NotificationController extends Controller
{
    private $validTypes = ['Lajm', 'Konkurs', 'Komunikatë'];

    public function index(Request $request)
    {
        $type = $request->query('type');
        $query = Notification::query();

        if ($type && in_array($type, $this->validTypes)) {
            $query->where('notificationType', $type);
        }

        $notifications = $query->orderBy('datetime', 'desc')->get();

        return view('notifications.index', [
            'notifications' => $notifications,
            'currentType' => $type,
            'types' => $this->validTypes
        ]);
    }

    public function create()
    {
        return view('notifications.createNotification', [
            'types' => $this->validTypes
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'imageUrl' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'datetime' => 'required|date',
            'title' => 'required|string|max:200',
            'description' => 'required|string',
            'notificationType' => 'required|in:Lajm,Konkurs,Komunikatë'
        ]);

        $path = $request->file('imageUrl')->store('public/notifications');
        $validated['imageUrl'] = Storage::url($path);

        Notification::create($validated);

        return redirect()->route('notifications.index')
            ->with('success', 'Njoftimi u krijua me sukses!');
    }

    public function edit(Notification $notification)
    {
        return view('notifications.editNotification', [
            'notification' => $notification,
            'types' => $this->validTypes
        ]);
    }

    public function update(Request $request, Notification $notification)
    {
        $validated = $request->validate([
            'imageUrl' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'datetime' => 'required|date',
            'title' => 'required|string|max:200',
            'description' => 'required|string',
            'notificationType' => 'required|in:Lajm,Konkurs,Komunikatë'
        ]);

        if ($request->hasFile('imageUrl')) {
            if ($notification->imageUrl) {
                $oldPath = str_replace('/storage', 'public', $notification->imageUrl);
                Storage::delete($oldPath);
            }

            $path = $request->file('imageUrl')->store('public/notifications');
            $validated['imageUrl'] = Storage::url($path);
        } else {
            $validated['imageUrl'] = $notification->imageUrl;
        }

        $notification->update($validated);

        return redirect()->route('notifications.index')
            ->with('success', 'Njoftimi u përditësua me sukses!');
    }

    public function destroy(Notification $notification)
    {
        if ($notification->imageUrl) {
            $path = str_replace('/storage', 'public', $notification->imageUrl);
            Storage::delete($path);
        }

        $notification->delete();

        return redirect()->route('notifications.index')
            ->with('success', 'Njoftimi u fshi me sukses!');
    }
}