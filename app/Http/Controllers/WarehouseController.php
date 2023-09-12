<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $warehouse = Warehouse::all();
        return response()->json(['success' => true, 'data' => $warehouse]);
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
            'warehouse_name' => 'required|string|min:3|max:20',
            'warehouse_location' => 'required|string|min:3|max:20',
            'encoded_by' => 'required|integer',
            // Add validation rules for other attributes as needed
        ]);


        $warehouse = Warehouse::create($validatedData);

        $newWarehouse = Warehouse::find($warehouse->id);

        return response()->json(['success' => true, 'data' => $newWarehouse]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Warehouse $warehouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Warehouse $warehouse)
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
            'warehouse_name' => 'required|string|min:3|max:20',
            'warehouse_location' => 'required|string|min:3|max:20',
            'edited_by' => 'required|integer',
            // Add validation rules for other attributes as needed
        ]);

        $warehouse = Warehouse::find($id);

        if (!$warehouse) {
            return response()->json(['error' => 'Warehouse not found.'], 404);
        }

        $warehouse->warehouse_name = $request->input('warehouse_name');
        $warehouse->warehouse_location = $request->input('warehouse_location');
        $warehouse->edited_by = $request->input('edited_by');

        $warehouse->save();

        return response()->json(['message' => 'Warehouse updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $warehouse = Warehouse::find($id);

        if (!$warehouse) {
            return response()->json(['error' => 'Warehouse not found.'], 404);
        }

        $warehouse->delete();

        return response()->json(['message' => 'Warehouse deleted successfully.']);
    }
}
