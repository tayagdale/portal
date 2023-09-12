<?php

namespace App\Http\Controllers;

use App\Models\InventoryStatus;
use Illuminate\Http\Request;

class InventoryStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventory_status = InventoryStatus::all();
        return response()->json(['success' => true, 'data' => $inventory_status]);
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
    public function show(InventoryStatus $inventoryStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InventoryStatus $inventoryStatus)
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
            'status_value' => 'required|integer',
            // Add validation rules for other attributes as needed
        ]);

        $inventory_status = InventoryStatus::find($id);

        if (!$inventory_status) {
            return response()->json(['error' => 'Inventory Status not found.'], 404);
        }

        $inventory_status->status_value = $request->input('status_value');

        $inventory_status->save();

        return response()->json(['message' => 'Inventory Status updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InventoryStatus $inventoryStatus)
    {
        //
    }
}
