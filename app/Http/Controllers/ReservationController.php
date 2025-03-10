<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Validator;

use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; //
use App\Models\Reservation_Item_Service;
use App\Models\reservationItem;
use App\Models\Service;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $userId = $request->user()->Reservation;
        $userId = $request->user()->id;

        $Book = Reservation::where('user_id', $userId)->get();
        return response()->json([
            'status' => 1,
            'message' => ' Table My Reservation',
            'Reservation_Details' => $Book
        ]);
    }

    //new new
    // func for all booking for User  (permission for Manager and admin)
    public function allreser(Request $request)
    {
        $Book = Reservation::all();
        return response()->json([
            'status' => 1,
            'message' => ' Table My Reservation',
            'Reservation_Details' => $Book
        ]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    public function store(ReservationRequest $request)
    {
        $userId = $request->user()->id;
        $validatedData = $request->validated();
        $validatedData['user_id'] = $userId;
        $totalAmount = 0;
        $validatedData['total_amount'] = $totalAmount;

        foreach ($request->items as $item) {
            $room = Room::findOrFail($item['room_id']);

            $isRoomAvailable = !reservationItem::where('room_id', $room->id)
                ->where(function ($query) use ($item) {
                    $query->where(function ($subQuery) use ($item) {
                        $subQuery->where('check_in_date', '<', $item['check_out_date'])
                            ->where('check_out_date', '>', $item['check_in_date']);
                    });
                })
                ->exists();

            if (!$isRoomAvailable) {
                return response()->json(['error' => 'Room not available for the selected date'], 400);
            }

            $itemPrice = $room->price * $item['number_of_nights'];
            $totalAmount += $itemPrice;
        }

        $reservation = Reservation::create($validatedData);

        foreach ($request->items as $item) {
            $room = Room::findOrFail($item['room_id']);


            $validator = Validator::make($item, [
                'check_in_date' => 'required|date|after_or_equal:today',
                'check_out_date' => 'required|date|after:check_in_date',

            ], [
                'check_in_date.after_or_equal' => 'The check-in date must be today or later.',
                'check_out_date.after' => 'The check-out date must be after the check-in date.',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }

            $validatedItem = $validator->validated();

            reservationItem::create([
                'reservation_id' => $reservation->id,
                'room_id' => $room->id,
                'check_in_date' => $validatedItem['check_in_date'],
                'check_out_date' => $validatedItem['check_out_date'],
                'children_count' => $item['children_count'] ?? 0,
                'adults_count' => $item['adults_count'] ?? 1,
                'number_of_nights' => $item['number_of_nights'],
                'room_price' => $room->price,
                'subtotal' => $room->price * $item['number_of_nights'],
            ]);
        }

        if ($request->filled('services')) {
            foreach ($request->services as $service) {
                $serviceData = Service::findOrFail($service['service_id']);

                $reservationItems = reservationItem::where('reservation_id', $reservation->id)->get();

                foreach ($reservationItems as $reservationItem) {
                    Reservation_Item_Service::create([
                        'services_id' => $serviceData->id,
                        'reservation_items_id' => $reservationItem->id,
                        'service_price' => $serviceData->price,
                        'quantity' => $service['quantity'] ?? 1,
                        'subtotal_services' => $serviceData->price * ($service['quantity'] ?? 1),
                    ]);
                }

                $totalAmount += $serviceData->service_price * ($service['quantity'] ?? 1);
            }

            $reservation->update(['total_amount' => $totalAmount]);
        }

        // Mail::to($reservation->guest_email)->send(new ReservationConfirmation($reservation));


        return response()->json([
            'status' => 1,
            'message' => 'Reservation created successfully',
            'reservation' => $reservation->load(['reservation_items'])

        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $Book = Reservation::findOrFail($id);
        return response()->json([
            'status' => 1,
            'message' => ' Reservation id :',
            'Reservation_Details' => $Book
        ]);
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
        $Reserv = Reservation::findOrFail($id);
        $request->validate([

            'Reservistion_status' => 'required|in:CONFIRMED,CANCELLED,COMPLETED',

        ]);

        $Reserv->update([
            'status' => $request->status
        ]);
        return response()->json([
            'status' => 1,
            'message' => ' Succ Updated Reservation',
            'Reservation_Details' => $Reserv
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Reservation::findOrFail($id);
        Reservation::destroy($id);

        return response()->json(['message' => 'Deleted Reservation']);
    }


    // func calculater points 
    
    // public function calculatePoints($totalPrice, $servicesCount) {
    //     $basePoints = $totalPrice * 0.05;
    //     $servicePoints = $servicesCount * 2;
    //     return $basePoints + $servicePoints;
    // }

}
