<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Media;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class MediaController extends Controller
{
    private const ALLOWED_MIME = [
        'image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml',
        'application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    ];

    private const MAX_SIZE_MB = 10;

    public function index(): View
    {
        $media = auth()->user()->organisation
            ->media()
            ->latest()
            ->get();

        return view('media.index', compact('media'));
    }

    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $request->validate([
            'file' => [
                'required',
                'file',
                'max:' . (self::MAX_SIZE_MB * 1024),
                'mimetypes:' . implode(',', self::ALLOWED_MIME),
            ],
        ]);

        $org  = auth()->user()->organisation;
        $file = $request->file('file');

        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path     = $org->id . '/' . $filename;

        Storage::disk('uploads')->putFileAs($org->id, $file, $filename);

        $media = Media::create([
            'organisation_id' => $org->id,
            'uploaded_by'     => auth()->id(),
            'filename'        => $filename,
            'original_name'   => $file->getClientOriginalName(),
            'mime_type'       => $file->getMimeType(),
            'size'            => $file->getSize(),
            'path'            => $path,
            'url'             => Storage::disk('uploads')->url($path),
        ]);

        AuditLog::record('media.uploaded', $org->id, auth()->id(), [
            'file' => $file->getClientOriginalName(),
        ]);

        if ($request->expectsJson()) {
            return response()->json(['url' => $media->url, 'id' => $media->id]);
        }

        return back()->with('status', '"' . $file->getClientOriginalName() . '" uploaded.');
    }

    public function destroy(Media $media): RedirectResponse
    {
        abort_if($media->organisation_id !== auth()->user()->organisation_id, 403);
        abort_unless(auth()->user()->isAdmin(), 403);

        $name = $media->original_name;
        $media->delete(); // deletes file via model booted hook

        AuditLog::record('media.deleted', auth()->user()->organisation_id, auth()->id(), [
            'file' => $name,
        ]);

        return back()->with('status', '"' . $name . '" deleted.');
    }
}
