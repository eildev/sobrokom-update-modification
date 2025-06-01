<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReviewRating;
use App\Models\ReviewImages;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Support\Facades\Auth;

class ReviewRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $reviews = ReviewRating::all();
       return view('backend.Ratingmanage.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // @dd($request);
        // Validate the incoming data
        $validatedData = $request->validate([
            'message' => 'required|string|max:250',
        ]);


        $order = Order::where('user_identity', Auth::user()->id)->where('status', 'completed')->latest()->first();
        if (!empty($order->id)) {
            $orderDetail = OrderDetails::where('order_id', $order->id)
                ->where('product_id', $request->product_id)
                ->latest()
                ->first();
        }


        // Create and save the review
        $review_rating = new ReviewRating();
        $review_rating->user_id = Auth::user()->id;
        $review_rating->product_id = $request->product_id;
        $review_rating->rating = $request->rating;
        $review_rating->review = $request->message;
        // if($orderDetail){
        //     $review_rating->review_status="Approved";
        // }
        // else{
            $review_rating->review_status="Pending";
        // }
        $review_rating->save();
        if ($request->imageGallery) {
            $imagesGallery = $request->imageGallery;
            foreach ($imagesGallery as $image) {
                $galleryImage = rand() . '.' . $image->extension();
                $image->move(public_path('uploads/review_image'), $galleryImage);
                $review_mages = new ReviewImages;
                $review_mages->review_id = $review_rating->id;
                $review_mages->image = $galleryImage;
                $review_mages->save();
            }
        }

        // Redirect back or return a response
        return back()->with('success', 'Review submitted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $review_rating = ReviewRating::where('review_status','Approved')->where('product_id',$id)->get();
        // dd($review_rating);
        return view('frontend.e-com.product_details', compact('review_rating'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function approve($id){
        $review = ReviewRating::find($id);
        $review->review_status = 'Approved';
        $review->save();
        return back()->with('success', 'Review Approved successfully!');
    }

    public function delete($id){
        $review = ReviewRating::find($id);
        $review->review_status = 'Cancelled';
        $review->delete();
        return back()->with('success', 'Review Deleted successfully!');
    }
}
