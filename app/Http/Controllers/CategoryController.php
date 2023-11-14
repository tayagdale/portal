<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json(['success' => true, 'data' => $categories]);
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
        $validatedData = $request->validate([
            'category_name' => 'required|string|min:3|max:20|unique:categories,category_name',
            'encoded_by' => 'required|integer',
            // Add validation rules for other attributes as needed
        ]);


        $category = Category::create($validatedData);

        $newCategory = Category::find($category->id);

        return response()->json(['success' => true, 'data' => $newCategory]);
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
        // Validate the input data from the edit form
        $request->validate([
            'category_name' => 'required|string|min:3|max:20',
            'edited_by' => 'required|integer',
            // Add validation rules for other attributes as needed
        ]);

        $categpry = Category::find($id);

        if (!$categpry) {
            return response()->json(['error' => 'Category not found.'], 404);
        }

        $categpry->category_name = $request->input('category_name');
        $categpry->edited_by = $request->input('edited_by');

        $categpry->save();

        return response()->json(['message' => 'Category updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['error' => 'Category not found.'], 404);
        }

        $category->delete();

        return response()->json(['message' => 'Category deleted successfully.']);
    }
}
