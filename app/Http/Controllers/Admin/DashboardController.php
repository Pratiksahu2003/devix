<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OurWork;
use App\Models\OurWorkImage;
use App\Models\OurWorkVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index()
    {
        $ourWork = OurWork::query()->latest('id')->first();
        $ourWorkImages = OurWorkImage::query()->orderBy('sort_order')->get();
        $ourWorkVideos = $ourWork
            ? OurWorkVideo::query()
                ->where('our_work_id', $ourWork->id)
                ->orderBy('sort_order')
                ->get()
            : collect();

        return view('admin.dashboard', compact('ourWork', 'ourWorkImages', 'ourWorkVideos'));
    }

    public function ourWork(): View
    {
        $ourWork = OurWork::query()->latest('id')->first();
        $ourWorkImages = OurWorkImage::query()->orderBy('sort_order')->get();
        $ourWorkVideos = $ourWork
            ? OurWorkVideo::query()
                ->where('our_work_id', $ourWork->id)
                ->orderBy('sort_order')
                ->get()
            : collect();

        return view('admin.our-work', compact('ourWork', 'ourWorkImages', 'ourWorkVideos'));
    }

    public function updateOurWork(Request $request)
    {
        $validated = $request->validate([
            // Legacy single URL field (kept for backwards compatibility)
            'youtube_url' => 'nullable|url|max:255',
            // New multiple URLs field: textarea with one URL per line (or separated by commas)
            'youtube_urls' => 'nullable|string|max:5000',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|max:4096',
        ]);

        // Make sure there is always an OurWork record before we attach videos/images.
        $ourWork = OurWork::query()->latest('id')->first();

        $youtubeUrls = [];
        $shouldUpdateVideos = $request->filled('youtube_urls') || $request->filled('youtube_url');

        if ($shouldUpdateVideos) {
            if ($request->filled('youtube_urls')) {
                $raw = (string) ($validated['youtube_urls'] ?? '');
                $parts = preg_split('/[\r\n,]+/', $raw) ?: [];
                foreach ($parts as $part) {
                    $u = trim((string) $part);
                    if ($u !== '') {
                        $youtubeUrls[] = $u;
                    }
                }
            }

            if ($request->filled('youtube_url')) {
                $youtubeUrls[] = (string) ($validated['youtube_url'] ?? '');
            }

            // Preserve order while removing duplicates
            $unique = [];
            foreach ($youtubeUrls as $u) {
                if (!in_array($u, $unique, true)) {
                    $unique[] = $u;
                }
            }
            $youtubeUrls = $unique;

            if (!empty($youtubeUrls)) {
                $invalid = [];
                foreach ($youtubeUrls as $i => $url) {
                    if (!filter_var($url, FILTER_VALIDATE_URL)) {
                        $invalid[] = 'Line ' . ($i + 1) . ' has an invalid URL.';
                    }
                }

                if (!empty($invalid)) {
                    return redirect()
                        ->back()
                        ->withErrors(['youtube_urls' => implode("\n", $invalid)])
                        ->withInput();
                }

                if (! $ourWork) {
                    $ourWork = OurWork::create([
                        'admin_id' => auth('admin')->id(),
                        'youtube_url' => null,
                    ]);
                }

                OurWorkVideo::query()
                    ->where('our_work_id', $ourWork->id)
                    ->delete();

                $sortOrder = 1;
                foreach ($youtubeUrls as $url) {
                    OurWorkVideo::create([
                        'our_work_id' => $ourWork->id,
                        'youtube_url' => $url,
                        'sort_order' => $sortOrder,
                    ]);

                    $sortOrder++;
                }

                // Keep the legacy `our_works.youtube_url` as "featured" (first URL)
                $ourWork->youtube_url = $youtubeUrls[0];
                $ourWork->save();
            }
        }

        // Upload images (multiple)
        if ($request->hasFile('images')) {
            if (! $ourWork) {
                $ourWork = OurWork::create([
                    'admin_id' => auth('admin')->id(),
                    'youtube_url' => null,
                ]);
            }

            $files = $request->file('images');
            if (is_array($files) || $files instanceof \Illuminate\Http\UploadedFile) {
                $files = is_array($files) ? $files : [$files];
            }

            $nextSortOrder = (OurWorkImage::query()
                ->where('our_work_id', $ourWork->id)
                ->max('sort_order') ?? 0) + 1;

            foreach ($files as $file) {
                if (! $file || ! $file->isValid()) {
                    continue;
                }

                $path = $file->store('our-work', 'public');
                $alt = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

                OurWorkImage::create([
                    'our_work_id' => $ourWork->id,
                    'image_path' => $path,
                    'alt_text' => $alt ?: null,
                    'sort_order' => $nextSortOrder,
                ]);

                $nextSortOrder++;
            }
        }

        return redirect()->route('admin.dashboard')->with('success', 'Our Work updated successfully.');
    }

    public function deleteOurWorkImage(OurWorkImage $image)
    {
        if ($image->image_path) {
            Storage::disk('public')->delete($image->image_path);
        }

        $image->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Image deleted successfully.');
    }
}
