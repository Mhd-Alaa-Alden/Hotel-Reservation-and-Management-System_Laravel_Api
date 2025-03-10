<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $usre = User::all();
        return response()->json(['message' => 'All user', 'user' => $usre], 200);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $usre = User::find($id);

        if (!$usre) {
            return response()->json([
                'message' => 'user not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'User Show successfully.',
            'User_Details' => $usre,
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = user::findOrFail($id);
        user::destroy($id);

        return response()->json([

            'status' => '1',
            'message' => 'user Deleted Successfully',
            'status' => '200',
        ]);
    }
}
