<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ImageGallery;
use App\Models\HomeBanner;
use App\Services\ImageOptimizerService;
class HomeBannerController extends Controller
{
    // banner index function
    public function index()
    {
        return view('backend.home_banner.insert');
    }

    // banner store function
    public function store(Request $request,ImageOptimizerService $imageService)
    {
        $request->validate([
            'title' => 'required|max:50',
            'short_description' => 'required|max:100',
            'long_description' => 'required|max:200',
            'link' => 'required|max:200',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->image) {
            $destinationPath = public_path('uploads/banner/');

            // Process each image
            $imageName = $imageService->resizeAndOptimize($request->file('image'), $destinationPath);
            $banner = new HomeBanner;
            $banner->title = $request->title;
            $banner->short_description = $request->short_description;
            $banner->long_description = $request->long_description;
            $banner->link = $request->link;
            $banner->image = $imageName;
            $banner->save();
            if ($request->galleryimages) {
                $allImages = $request->galleryimages;
                foreach ($allImages as $galleryImage) {
                          $destinationPath = public_path('uploads/banner/gallery/');
                            // $filename = time() . '_' . uniqid() . '.' . $galleryImage->extension();
                            $imageName = $imageService->resizeAndOptimize($galleryImage, $destinationPath);
                            $image = '/uploads/banner/gallery/'.$imageName;
                    $ImageGallery = new ImageGallery;
                    $ImageGallery->banner_id = $banner->id;
                    $ImageGallery->image = $image;
                    $ImageGallery->save();
                }
            }
            return back()->with('success', 'banner Successfully Saved');
        }
    }

    // banner View function
    public function view()
    {
        $all_banner = HomeBanner::all();
        return view('backend.home_banner.view', compact('all_banner'));
    }

    // banner Edit function
    public function edit($id)
    {
        $banner = HomeBanner::findOrFail($id);
        return view('backend.home_banner.edit', compact('banner'));
    }


    // banner update function
    public function update(Request $request, $id, ImageOptimizerService $imageService)
    {
        $request->validate([
            'title' => 'required|max:50',
            'short_description' => 'required|max:100',
            'long_description' => 'required|max:200',
            'link' => 'required|max:200',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $banner = HomeBanner::findOrFail($id);

        // If banner image is present, process it
        if ($request->hasFile('image')) {
            $destinationPath = public_path('uploads/banner/');
            $imageName = $imageService->resizeAndOptimize($request->file('image'), $destinationPath);

            // Delete old image if exists
            if ($banner->image && file_exists(public_path('uploads/banner/' . $banner->image))) {
                unlink(public_path('uploads/banner/' . $banner->image));
            }

            $banner->image = $imageName;
        }

        // Always update text fields
        $banner->title = $request->title;
        $banner->short_description = $request->short_description;
        $banner->long_description = $request->long_description;
        $banner->link = $request->link;
        $banner->update();

        // Optional: Process gallery images
        if ($request->hasFile('galleryimages')) {
            foreach ($request->galleryimages as $galleryImage) {
                $destinationPath = public_path('uploads/banner/gallery/');
                $imageName = $imageService->resizeAndOptimize($galleryImage, $destinationPath);
                $image = '/uploads/banner/gallery/'.$imageName;
                $ImageGallery = new ImageGallery();
                $ImageGallery->banner_id = $banner->id;
                $ImageGallery->image = $image; // ✅ save only filename, not full path
                $ImageGallery->save(); // ✅ was incorrectly using update() before
            }
        }

        return back()->with('success', 'Banner successfully updated.');
    }

    // banner Delete function
    public function delete($id)
    {
        $banner = HomeBanner::findOrFail($id);
        unlink(public_path('uploads/banner/') . $banner->image);
        $banner->delete();
        return back()->with('success', 'banner Successfully deleted');
    }
    public function bannerStatus($id)
    {
        // dd($request);
        $banner = HomeBanner::findOrFail($id);
        if ($banner->status == 0) {
            $newStatus = 1;
        } else {
            $newStatus = 0;
        }

        $banner->update([
            'status' => $newStatus
        ]);
        return redirect()->back()->with('success', 'status changed successfully');
        // return response()->json([
        //     'status' => '200',
        //     'message' => 'banner inactive successful',
        // ]);
    }
}
