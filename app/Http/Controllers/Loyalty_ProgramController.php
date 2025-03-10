<?php

namespace App\Http\Controllers;

use App\Http\Requests\Loyalty_ProgramRequest;
use App\Models\LoyaltyProgram;
use App\Models\Reservation;
use Illuminate\Http\Request;

class Loyalty_ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loyalty = LoyaltyProgram::all();
        return response()->json(['message' => 'All Loyalty_Program', 'Loyalty_Program' => $loyalty], 200);
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
    public function store(Loyalty_ProgramRequest $request)
    {
        $validated =  $request->validated();
        $loyalty =  LoyaltyProgram::create($validated);
        return response()->json(['message' => 'Successfully program', 'Loyalty_Program' => $loyalty], 200);
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


    // public function updateLoyaltyLevel($user)
    // {
    //     $levels = [
    //         ['name' => 'Level 1', 'min_points' => 0],
    //         ['name' => 'Level 2', 'min_points' => 500],
    //         ['name' => 'Level 3', 'min_points' => 1500],
    //     ];

    //     foreach ($levels as $level) {
    //         if ($user->total_points >= $level['min_points']) {
    //             $user->loyalty_level = $level['name'];
    //         }
    //     }
    //     $user->save();
    // }




    /**
     * Update the specified resource in storage.
     */
    public function update(Loyalty_ProgramRequest $request, string $id)
    {
        $loyalty = LoyaltyProgram::findOrFail($id);

        $vaildated = $request->validated();
        $loyalty->update($vaildated);

        return response()->json($loyalty, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $loyalty = LoyaltyProgram::findOrFail($id);

        if (!$loyalty) {
            return response()->json([
                'message' => 'loyalty_program not found'
            ], 404);
        } else {
            LoyaltyProgram::destroy($id);

            return response()->json([
                'status' => '1',
                'message' => 'loyalty deleted successfully',
                'status' => '200',
            ]);
        }
    }

    // بدي اختبر هدا التابع بكرا  وجربه
    public function updateLoyaltyLevel($user)
    {
        // حساب إجمالي الإنفاق وعدد الحجوزات ديناميكيًا
        $totalSpent = Reservation::where('user_id', $user->id)->sum('total_price');
        $totalBookings = Reservation::where('user_id', $user->id)->count();

        // جلب جميع المستويات من جدول الولاء
        $loyaltyLevels = LoyaltyProgram::orderBy('condition_value', 'asc')->get();

        foreach ($loyaltyLevels as $level) {
            // التحقق من استيفاء المستخدم لشرط الترقية
            if ($this->meetsCondition($user, $level, $totalSpent, $totalBookings)) {
                $user->loyalty_level = $level->LevelName;
                $user->discount_rate = $level->discount_rate;
                $user->additional_services = $level->additional_services;
            }
        }

        // حفظ التعديلات
        $user->save();
    }
    private function meetsCondition($user, $level, $totalSpent, $totalBookings)
    {
        switch ($level->condition_type) {
            case 'points':
                return $user->total_points >= $level->condition_value;
            case 'spending':
                return $totalSpent >= $level->condition_value;
            case 'bookings_count':
                return $totalBookings >= $level->condition_value;
            default:
                return false;
        }
    }
}
