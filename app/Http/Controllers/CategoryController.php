<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = Category::all();

        return response()->json([
            'status' => 1,
            'message' => ' Table My Category',
            'Category_Details' => $query
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
    public function store(CategoryRequest $request)
    {
        $validated =  $request->validated();
        $category =  Category::create($validated);
        return response()->json(['message' => 'Successfully added to wishlist', 'wislist' => $category], 200);
    }

    /**
     * Display the specified resource.
     */

    public function show(string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'message' => 'category not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'category successfully.',
            'Category' => $category,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $category = Category::findOrFail($id);

        $vaildated = $request->validated();
        $category->update($vaildated);

        return response()->json($category, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        Category::findOrFail($id);
        Category::destroy($id);

        return response()->json([

            'status' => '1',
            'message' => 'category deleted successfully',
            'status' => '200',
        ]);
    }
}
