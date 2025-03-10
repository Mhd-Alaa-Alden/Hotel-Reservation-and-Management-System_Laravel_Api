<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $userId = $request->user()->id;

        $review = Review::all();
        return response()->json(['message' => 'All review', 'review' => $review], 200);
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
    public function store(ReviewRequest $request)
    {
        $userId = $request->user()->id;
        $review['user_id'] = $userId;
        $review['room_id'] = $request->room_id;
        // $review['rating'] = $request ??

            $validated =  $request->validated();
        $review =  Review::create($validated);
        return response()->json(['message' => 'Successfully added to review', 'review' => $review], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(ReviewRequest $request, string $id)
    {
        $review = Review::findOrFail($id);

        $vaildated = $request->validated();
        $review->update($vaildated);

        return response()->json($review, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $review = Review::findOrFail($id);
        Review::destroy($id);

        return response()->json([

            'status' => '1',
            'message' => 'Review deleted successfully',
            'status' => '200',
        ]);
    }
}
