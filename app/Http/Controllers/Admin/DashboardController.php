<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OurWork;
use App\Models\OurWorkImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $ourWork = OurWork::query()->first();
        $ourWorkImages = OurWorkImage::query()->orderBy('sort_order')->get();

        return view('admin.dashboard', compact('ourWork', 'ourWorkImages'));
    }

    public function updateOurWork(Request $request)
    {
        $validated = $request->validate([
            'youtube_url' => 'nullable|url|max:255',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|max:4096',
        ]);

        // Option 1: YouTube link (single value)
        // Only update it if the request actually contains the field,
        // so image uploads won't accidentally overwrite the video.
        if ($request->has('youtube_url')) {
            $ourWork = OurWork::query()->first();
            if (! $ourWork) {
                $ourWork = OurWork::create([
                    'admin_id' => auth('admin')->id(),
                    'youtube_url' => null,
                ]);
            }

            $ourWork->youtube_url = $validated['youtube_url'] ?? null;
            $ourWork->save();
        }

        // Option 2: Upload images (multiple)
        if ($request->hasFile('images')) {
            $files = $request->file('images');
            if (is_array($files) || $files instanceof \Illuminate\Http\UploadedFile) {
                $files = is_array($files) ? $files : [$files];
            }

            $nextSortOrder = (OurWorkImage::query()->max('sort_order') ?? 0) + 1;

            foreach ($files as $file) {
                if (! $file || ! $file->isValid()) {
                    continue;
                }

                $path = $file->store('our-work', 'public');
                $alt = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

                OurWorkImage::create([
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
