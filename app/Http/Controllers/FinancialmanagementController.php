<?php

namespace App\Http\Controllers;

use App\Http\Requests\financialRequest;
use App\Models\Financialmanagement;
use Illuminate\Http\Request;

class FinancialmanagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $financial =  Financialmanagement::all();
        return response()->json(['message' => 'All Record', 'Financial' => $financial], 200);
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
    public function store(financialRequest $request)
    {
        $validated =  $request->validated();
        $financial =  Financialmanagement::create($validated);
        return response()->json(['message' => 'Successfully added to Record', 'financial' => $financial], 200);
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
    public function update(financialRequest $request, string $id)
    {
        $financial = Financialmanagement::findOrFail($id); {
            $vaildated = $request->validated();
            $financial->update($vaildated);

            return response()->json($financial, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Financialmanagement::findOrFail($id);
        Financialmanagement::destroy($id);

        return response()->json([

            'status' => '1',
            'message' => 'Record Deleted Successfully',
            'status' => '200',
        ]);
    }
}
