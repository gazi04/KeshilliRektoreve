<?php

namespace App\Http\Controllers;

use App\Http\Requests\Notification\CreateNotificationRequest;
use App\Http\Requests\Notification\EditNotificationRequest;
use App\Models\Notification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Throwable;

class NotificationController extends Controller
{
    private array $validTypes = ['Lajm', 'Konkurs', 'Komunikatë'];

    public function index(Request $request): View
    {
        try {
            $type = $request->query('type');
            $query = Notification::query();

            if ($type && in_array($type, $this->validTypes)) {
                $query->where('notificationType', $type);
            }

            $notifications = $query->orderBy('datetime', 'desc')->get();

            return view('notifications.index', [
                'notifications' => $notifications,
                'currentType' => $type,
                'types' => $this->validTypes,
            ]);
        } catch (Throwable $e) {
            Log::error('Error fetching notifications index: '.$e->getMessage(), ['exception' => $e]);

            return view('errors.custom-error', ['message' => 'Nuk mund të merreshin njoftimet.']);
        }
    }

    public function create(): View
    {
        try {
            return view('notifications.createNotification', ['types' => $this->validTypes]);
        } catch (Throwable $e) {
            Log::error('Error preparing create notification form: '.$e->getMessage(), ['exception' => $e]);

            return view('errors.custom-error', ['message' => 'Nuk mund të hapet forma për krijimin e njoftimit.']);
        }
    }

    public function store(CreateNotificationRequest $request): View|RedirectResponse
    {
        try {
            $validated = $request->validated();

            // Store image in the 'private_notifications' disk
            if ($request->hasFile('imageUrl')) {
                $imagePath = $request->file('imageUrl')->store('notifications', 'private_notifications');
                $validated['imageUrl'] = $imagePath;
            }

            Notification::create($validated);

            return redirect()->route('notifications.index')
                ->with('success', 'Njoftimi u krijua me sukses!');
        } catch (Throwable $e) {
            Log::error('Error storing notification: '.$e->getMessage(), ['exception' => $e, 'request_data' => $request->except('imageUrl')]);

            return view('errors.custom-error', ['message' => 'Nuk mund të krijohej njoftimi për shkak të një gabimi të brendshëm.']);
        }
    }

    public function edit(Notification $notification): View
    {
        try {
            return view('notifications.editNotification', [
                'notification' => $notification,
                'types' => $this->validTypes,
            ]);
        } catch (Throwable $e) {
            Log::error('Error preparing edit notification form: '.$e->getMessage(), ['exception' => $e, 'notification_id' => $notification->id]);

            return view('errors.custom-error', ['message' => 'Nuk mund të hapet forma për përditësimin e njoftimit.']);
        }
    }

    public function update(EditNotificationRequest $request, Notification $notification): View|RedirectResponse
    {
        try {
            $validated = $request->validated();

            if ($request->hasFile('imageUrl')) {
                // Delete old image from the private disk if it exists
                if ($notification->imageUrl && Storage::disk('private_notifications')->exists($notification->imageUrl)) {
                    Storage::disk('private_notifications')->delete($notification->imageUrl);
                }
                // Store new image in the 'private_notifications' disk
                $validated['imageUrl'] = $request->file('imageUrl')->store('notifications', 'private_notifications');
            } else {
                // If no new image is uploaded, retain the existing imageUrl
                $validated['imageUrl'] = $notification->imageUrl;
            }

            $notification->update($validated);

            return redirect()->route('notifications.index')
                ->with('success', 'Njoftimi u përditësua me sukses!');
        } catch (Throwable $e) {
            Log::error('Error updating notification: '.$e->getMessage(), ['exception' => $e, 'notification_id' => $notification->id, 'request_data' => $request->except('imageUrl')]);

            return view('errors.custom-error', ['message' => 'Nuk mund të përditësohej njoftimi për shkak të një gabimi të brendshëm.']);
        }
    }

    public function destroy(Notification $notification): View|RedirectResponse
    {
        try {
            // Delete image from the private disk if it exists
            if ($notification->imageUrl && Storage::disk('private_notifications')->exists($notification->imageUrl)) {
                Storage::disk('private_notifications')->delete($notification->imageUrl);
            }

            $notification->delete();

            return redirect()->route('notifications.index')
                ->with('success', 'Njoftimi u fshi me sukses!');
        } catch (Throwable $e) {
            Log::error('Error deleting notification: '.$e->getMessage(), ['exception' => $e, 'notification_id' => $notification->id]);

            return view('errors.custom-error', ['message' => 'Nuk mund të fshihej njoftimi për shkak të një gabimi të brendshëm.']);
        }
    }

    public function showImage(Notification $notification)
    {
        if ($notification->imageUrl && Storage::disk('private_notifications')->exists($notification->imageUrl)) {
            return Storage::disk('private_notifications')->response($notification->imageUrl);
        }

        return null;
    }
}
