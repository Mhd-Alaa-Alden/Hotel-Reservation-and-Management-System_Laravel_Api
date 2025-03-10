<?php

namespace App\Http\Controllers;

use App\Http\Requests\WishlistRequest;
use App\Models\Room;
use App\Models\Wishlist;
use Illuminate\Container\Attributes\Auth as AttributesAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WhishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // Wishlist::with('room')->where('user_id', Auth::id())->get();

        $wishlist = Wishlist::where('user_id', Auth::id())->get();

        $wishlistWithRooms = $wishlist->map(function ($item) {
            $room = Room::find($item->room_id);
            return [
                'id' => $item->id,
                'room_id' => $item->room_id,
                'user_id' => $item->user_id,
                'room' => $room ? [
                    'room_number' => $room->room_number,
                    'capacity' => $room->capacity,
                    'price' => $room->price,
                    'description' => $room->description,
                    'images' => $room->images
                ] : null
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'Wishlist retrieved successfully.',
            'data' => $wishlistWithRooms
        ]);
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
    public function store(WishlistRequest $request)
    {
        // $userId = $request->user()->id;
        $validated =  $request->validated();
        $wishlist =  Wishlist::create($validated);
        return response()->json(['message' => 'Successfully added to wishlist', 'wislist' => $wishlist], 200);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $wishlist = Wishlist::findOrFail($id);
        Wishlist::destroy($id);
        return response()->json(['message' => 'Deleted  Room  from Wishlist', 'wislist' => $wishlist], 200);
    }
}
