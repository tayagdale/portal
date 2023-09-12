<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventory = DB::table("inventory_details")
            ->select(array('*', 'items.brand_name as item_brand_name', 'unit_code', 'items.generic_name', DB::raw('SUM(inventory_details.qty) AS Iqty'), 'expiration_date'))
            ->leftJoin("items", "inventory_details.item_id", "=", "items.id")
            ->leftJoin("purchase_order_details", "inventory_details.po_number", "=", "purchase_order_details.po_number")
            ->leftJoin("units", "units.id", "=", "purchase_order_details.unit_id")
            ->orderBy('items.brand_name', 'desc')
            ->distinct()
            ->groupBy('purchase_order_details.unit_id')
            ->get();
        return response()->json(['success' => true, 'data' => $inventory]);
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
