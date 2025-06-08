<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Document;
use App\Models\Members;
use App\Models\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $sliderNotifications = Notification::whereNotNull('imageUrl')
            ->orderBy('datetime', 'desc')
            ->limit(3)
            ->get();

        $mainNews = Notification::where('notificationType', 'Lajm')
            ->orderBy('datetime', 'desc')
            ->first();

        $otherNews = Notification::where('notificationType', 'Lajm')
            ->orderBy('datetime', 'desc')
            ->when($mainNews, function ($query) use ($mainNews) {
                $query->where('id', '!=', $mainNews->id);
            })
            ->limit(3)
            ->get();

        $members = Members::orderBy('orderNr', 'asc')
            ->limit(4)
            ->get();

        $conferences = Conference::where('isActive', true)
            ->orderBy('date', 'desc')
            ->limit(4)
            ->get();

        $documents = Document::orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        return view('Client.index', [
            'sliderNotifications' => $sliderNotifications,
            'mainNews' => $mainNews,
            'otherNews' => $otherNews,
            'members' => $members,
            'conferences' => $conferences,
            'documents' => $documents,
        ]);
    }

    public function showNotification(Notification $notification): View
    {
        return view('Client.notification', [
            'notification' => $notification,
        ]);
    }

    public function notifications(): View
    {
        $filter = request()->query('filter', 'all');

        $notifications = Notification::query()
            ->when($filter !== 'all', function ($query) use ($filter) {
                $query->where('notificationType', $filter);
            })
            ->orderBy('datetime', 'desc')
            ->paginate(6);

        return view('Client.notifications', [
            'notifications' => $notifications,
            'activeFilter' => $filter,
        ]);
    }

    public function members(): View
    {
        $members = Members::orderBy('orderNr', 'asc')
            ->paginate(8);

        return view('Client.members', [
            'members' => $members,
        ]);
    }

    public function downloadDocument(Document $document)
    {
        if (Storage::disk('private_documents')->exists($document->url)) {
            $filename = $document->title.'.'.pathinfo((string) $document->url, PATHINFO_EXTENSION);

            return Storage::disk('private_documents')->download($document->url, $filename);
        }

        abort(404, 'Document not found.');
    }

    public function documents(): View
    {
        $documents = Document::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('Client.documents', [
            'documents' => $documents,
        ]);
    }

    public function conferences(): View
    {
        $conferences = Conference::where('isActive', true)
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('Client.conferences', [
            'conferences' => $conferences,
        ]);
    }

    public function showConference(Conference $conference): View
    {
        $conference->load('documents');

        return view('Client.conference', [
            'conference' => $conference,
        ]);
    }
}
