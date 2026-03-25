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

    public function ourWorkShow(): View
    {
        $ourWork = OurWork::query()->latest('id')->first();
        $ourWorkImages = OurWorkImage::query()->orderBy('sort_order')->get();
        $ourWorkVideos = $ourWork
            ? OurWorkVideo::query()
                ->where('our_work_id', $ourWork->id)
                ->orderBy('sort_order')
                ->get()
            : collect();

        return view('admin.our-work-show', compact('ourWork', 'ourWorkImages', 'ourWorkVideos'));
    }

    public function ourWorkCreate(): View
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

    public function ourWorkVideosShow(): View
    {
        $ourWork = OurWork::query()->latest('id')->first();
        $ourWorkVideos = $ourWork
            ? OurWorkVideo::query()
                ->where('our_work_id', $ourWork->id)
                ->orderBy('sort_order')
                ->get()
            : collect();

        return view('admin.our-work-videos-show', compact('ourWork', 'ourWorkVideos'));
    }

    public function ourWorkVideosCreate(): View
    {
        $ourWork = OurWork::query()->latest('id')->first();
        $ourWorkVideos = $ourWork
            ? OurWorkVideo::query()
                ->where('our_work_id', $ourWork->id)
                ->orderBy('sort_order')
                ->get()
            : collect();

        return view('admin.our-work-videos-create', compact('ourWork', 'ourWorkVideos'));
    }

    public function ourWorkImagesShow(): View
    {
        $ourWork = OurWork::query()->latest('id')->first();
        $ourWorkImages = OurWorkImage::query()->orderBy('sort_order')->get();

        return view('admin.our-work-images-show', compact('ourWork', 'ourWorkImages'));
    }

    public function ourWorkImagesCreate(): View
    {
        $ourWork = OurWork::query()->latest('id')->first();
        $ourWorkImages = OurWorkImage::query()->orderBy('sort_order')->get();

        return view('admin.our-work-images-create', compact('ourWork', 'ourWorkImages'));
    }

    public function ourWorkVideosEdit(OurWorkVideo $video): View
    {
        $ourWork = OurWork::query()->find($video->our_work_id);
        return view('admin.our-work-videos-edit', compact('ourWork', 'video'));
    }

    public function updateOurWorkVideo(Request $request, OurWorkVideo $video)
    {
        $validated = $request->validate([
            'youtube_url' => 'required|url|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $video->youtube_url = $validated['youtube_url'];
        if (array_key_exists('sort_order', $validated) && $validated['sort_order'] !== null) {
            $video->sort_order = (int) $validated['sort_order'];
        }
        $video->save();

        // Re-sync "featured" url from the first video by sort order.
        $this->syncFeaturedVideoFromWorkId($video->our_work_id);

        return redirect()
            ->route('admin.dashboard.our-work.videos.show')
            ->with('success', 'Video updated successfully.');
    }

    public function deleteOurWorkVideo(OurWorkVideo $video)
    {
        $workId = $video->our_work_id;
        $video->delete();

        // Re-order after delete to keep sort_order clean.
        $videos = OurWorkVideo::query()
            ->where('our_work_id', $workId)
            ->orderBy('sort_order')
            ->get();

        $i = 1;
        foreach ($videos as $v) {
            $v->sort_order = $i;
            $v->save();
            $i++;
        }

        $this->syncFeaturedVideoFromWorkId($workId);

        return redirect()
            ->route('admin.dashboard.our-work.videos.show')
            ->with('success', 'Video deleted successfully.');
    }

    public function ourWorkImagesEdit(OurWorkImage $image): View
    {
        $ourWork = OurWork::query()->find($image->our_work_id);
        return view('admin.our-work-images-edit', compact('ourWork', 'image'));
    }

    public function updateOurWorkImage(Request $request, OurWorkImage $image)
    {
        $validated = $request->validate([
            'alt_text' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'image' => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('image')) {
            if ($image->image_path) {
                Storage::disk('public')->delete($image->image_path);
            }

            $path = $request->file('image')->store('our-work', 'public');
            $image->image_path = $path;
        }

        $image->alt_text = $validated['alt_text'] ?? null;
        if (array_key_exists('sort_order', $validated) && $validated['sort_order'] !== null) {
            $image->sort_order = (int) $validated['sort_order'];
        }
        $image->save();

        return redirect()
            ->route('admin.dashboard.our-work.images.show')
            ->with('success', 'Image updated successfully.');
    }

    private function syncFeaturedVideoFromWorkId(int $ourWorkId): void
    {
        $featured = OurWorkVideo::query()
            ->where('our_work_id', $ourWorkId)
            ->orderBy('sort_order')
            ->value('youtube_url');

        $work = OurWork::query()->find($ourWorkId);
        if ($work) {
            $work->youtube_url = $featured ?: null;
            $work->save();
        }
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
            // If the admin provided multiline URLs, errors should show under `youtube_urls`.
            $invalidErrorKey = $request->filled('youtube_urls') ? 'youtube_urls' : 'youtube_url';

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
                        ->withErrors([$invalidErrorKey => implode("\n", $invalid)])
                        ->withInput();
                }

                if (! $ourWork) {
                    $ourWork = OurWork::create([
                        'admin_id' => auth('admin')->id(),
                        'youtube_url' => null,
                    ]);
                }

                $existingVideos = OurWorkVideo::query()
                    ->where('our_work_id', $ourWork->id)
                    ->orderBy('sort_order')
                    ->get(['youtube_url', 'sort_order']);

                $existingSet = [];
                foreach ($existingVideos as $vid) {
                    $existingSet[$vid->youtube_url] = true;
                }

                $sortOrder = $existingVideos->max('sort_order') ?? 0;

                // If this is the first time we are saving videos but legacy `our_works.youtube_url` exists,
                // preserve it as featured by inserting it as the first video row.
                if ($existingVideos->isEmpty() && !empty($ourWork->youtube_url) && !isset($existingSet[$ourWork->youtube_url])) {
                    $sortOrder = 1;
                    OurWorkVideo::create([
                        'our_work_id' => $ourWork->id,
                        'youtube_url' => $ourWork->youtube_url,
                        'sort_order' => $sortOrder,
                    ]);
                    $existingSet[$ourWork->youtube_url] = true;
                }

                foreach ($youtubeUrls as $url) {
                    // Allow one-by-one uploads by appending instead of deleting/replacing existing rows.
                    if (isset($existingSet[$url])) {
                        continue;
                    }

                    $sortOrder++;
                    OurWorkVideo::create([
                        'our_work_id' => $ourWork->id,
                        'youtube_url' => $url,
                        'sort_order' => $sortOrder,
                    ]);
                    $existingSet[$url] = true;
                }

                // Keep `our_works.youtube_url` in sync with the first video row.
                $featured = OurWorkVideo::query()
                    ->where('our_work_id', $ourWork->id)
                    ->orderBy('sort_order')
                    ->value('youtube_url');

                $ourWork->youtube_url = $featured ?: $ourWork->youtube_url;
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

        $workId = (int) $image->our_work_id;
        $image->delete();

        // Re-order after delete to keep sort_order clean.
        $images = OurWorkImage::query()
            ->where('our_work_id', $workId)
            ->orderBy('sort_order')
            ->get();

        $i = 1;
        foreach ($images as $img) {
            $img->sort_order = $i;
            $img->save();
            $i++;
        }

        return redirect()
            ->route('admin.dashboard.our-work.images.show')
            ->with('success', 'Image deleted successfully.');
    }
}
