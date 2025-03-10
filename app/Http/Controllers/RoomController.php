<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\updateRoomRequest;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // public function index()

    // {

    //     $rooms = Room::with('categorys:id,name')->get();

    //     foreach ($rooms as $room) {
    //         if ($room->images) {
    //             $room->images = asset('storage/' . $room->images);
    //         }
    //         $room->category_name = $room->category ? $room->category->name : null;
    //     }

    //     return response()->json(['message' => 'All Room', 'rooms' => $rooms], 200);
    // }

    public function index()
    {
        $rooms = Room::with('category')->get();

        foreach ($rooms as $room) {
            if ($room->images) {
                $room->images = asset('storage/' . $room->images);
            }
            $room->category_name = $room->category ? $room->category->category_name : 'No Category';
        }

        return response()->json(['message' => 'All Room', 'rooms' => $rooms], 200);
    }



    public function searchroom(SearchRequest $request)
    {
        $query = Room::query();

        if ($request->filled('price')) {
            $query->where('price', '=', $request->price);
        }

        if ($request->filled('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        if ($request->filled('check_in_date') && $request->filled('check_out_date')) {
            $checkinDate = \Carbon\Carbon::parse($request->check_in_date)->format('Y-m-d');
            $checkoutDate = \Carbon\Carbon::parse($request->check_out_date)->format('Y-m-d');

            $query->whereDoesntHave('reservation_Items', function ($subQuery) use ($checkinDate, $checkoutDate) {
                $subQuery->where(function ($q) use ($checkinDate, $checkoutDate) {
                    $q->where('check_in_date', '<', $checkoutDate)
                        ->where('check_out_date', '>', $checkinDate);
                });
            });
        }

        if ($request->filled('priceFrom') && $request->filled('priceTo')) {
            $query->whereBetween('price', [$request->priceFrom, $request->priceTo]);
        } elseif ($request->filled('priceFrom')) {
            $query->where('price', '>=', $request->priceFrom);
        } elseif ($request->filled('priceTo')) {
            $query->where('price', '<=', $request->priceTo);
        }

        if ($request->filled('sortby') && $request->filled('sortorder')) {
            $allowedSortFields = ['price', 'created_at', 'name']; // 🛠 حماية من SQL Injection
            $sortField = in_array($request->sortby, $allowedSortFields) ? $request->sortby : 'created_at';
            $sortOrder = in_array(strtolower($request->sortorder), ['asc', 'desc']) ? $request->sortorder : 'asc';

            $query->orderBy($sortField, $sortOrder);
        }

        $filteredRooms = clone $query;


        $rooms = $filteredRooms->paginate(5);

        if ($rooms->isEmpty()) {
            return response()->json([
                'status' => '0',
                'message' => 'No rooms found matching your criteria.',
                'data' => [],
            ], 404);
        }

        return response()->json([
            'status' => '1',
            'message' => 'success',
            'data' => $filteredRooms->paginate(5),
            'allAvailableRooms' => Room::paginate(5),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomRequest $request)
    {

        $validated = $request->validated();

        //Start Uploading images 
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $path = $image->store('Rooms_image', 'public');
            $validated['images'] = $path;

            // $path = $image->store('Rooms_image', 'public');  logic 2 -> store   طريقة 2
            //End Uploading images
        }
        $AddRoom = Room::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Room added successfully.',
            'Room_Details' => $AddRoom,

        ]);

        // return FcmService::notify('Notification', ' Room added successfully', [""]);

        //     return (new RoomResource($AddRoom))
        //         ->additional([
        //             'meta' =>  [
        //                 'success' => true,
        //                 'message' => 'Room added successfully.',
        //             ],
        //         ])
        //         ->response()
        //         ->setStatusCode(201);
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Room = Room::find($id);

        if (!$Room) {
            return response()->json([
                'message' => 'Room not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Room Show successfully.',
            'Room_Details' => $Room,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateRoomRequest $request, string $id)
    {
        $room = Room::findOrFail($id);

        $vaildated = $request->validated();
        $room->update($vaildated);
        return response()->json($room, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $Room = Room::findOrFail($id);
        Room::destroy($id);

        return response()->json([

            'status' => '1',
            'message' => 'Room deleted successfully',
            'status' => '200',
        ]);
    }
}
