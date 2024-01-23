<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }



    public function get_inventory_by_order_slip(string $id)
    {
        $inventory_details = DB::table("inventory_details")
            ->select(array('inventory_details.lot_no', 'inventory.*', 'inventory_details.id as iID', 'inventory_details.expiration_date', 'inventory_details.qty as iQty'))
            ->leftJoin("inventory", "inventory_details.item_id", "=", "inventory.item_id")
            ->leftJoin("order_slip_details", "inventory_details.item_id", "=", "order_slip_details.item_id")
            ->distinct()
            ->where('order_slip_details.os_number', $id)
            ->where('inventory_details.qty', '>', 1)
            ->distinct('inventory_details.lot_no')
            ->groupBy('inventory_details.lot_no')
            ->get();
        return response()->json(['success' => true, 'data' => $inventory_details]);
    }

    public function get_inventory_by_item_id(string $id)
    {
        $inventory_details = DB::table("inventory_details")
            ->select(array('po_number', 'lot_no', 'expiration_date', 'inspection_date', DB::raw('SUM(inventory_details.qty) AS Iqty')))
            ->where('item_id', $id)
            ->groupBy('inventory_details.lot_no')
            ->get();
        return response()->json(['success' => true, 'data' => $inventory_details]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
