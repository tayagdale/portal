<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller


{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $items = DB::table("items")
            ->select(
                "items.*",
                DB::raw("(SELECT category_name FROM categories WHERE id = items.category_id) as category"),
            )
            ->get();
        return response()->json(['success' => true, 'data' => $items]);
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
            'category_id' => 'required|integer',
            'generic_name' => 'required|string|min:3|max:255|unique:items,generic_name',
            'brand_name' => 'required|string|min:3|max:255|unique:items,brand_name',
            'encoded_by' => 'required|integer',
            // Add validation rules for other attributes as needed
        ]);


        $item = Item::create($validatedData);

        $newItem = Item::find($item->id);

        return response()->json(['success' => true, 'data' => $newItem]);
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
        $request->validate([
            'category_id' => 'required|integer',
            'generic_name' => 'required|string|min:3|max:20',
            'brand_name' => 'required|string|min:3|max:20',
            'edited_by' => 'required|integer',
            // Add validation rules for other attributes as needed
        ]);

        $item = Item::find($id);

        if (!$item) {
            return response()->json(['error' => 'Item not found.'], 404);
        }

        $item->category_id = $request->input('category_id');
        $item->generic_name = $request->input('generic_name');
        $item->brand_name = $request->input('brand_name');
        $item->edited_by = $request->input('edited_by');

        $item->save();

        return response()->json(['message' => 'Item updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Item::find($id);

        if (!$item) {
            return response()->json(['error' => 'Item not found.'], 404);
        }

        $item->delete();

        return response()->json(['message' => 'Item deleted successfully.']);
    }
}
