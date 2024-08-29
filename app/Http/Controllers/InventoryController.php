<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Unit;
use App\Models\InventoryDetail;
use App\Models\Item;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use App\Models\Supplier;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $inventory = DB::table("inventory_details")
        //     ->select(array('*', 'suppliers.supplier_code as supp', 'inventory_details.item_id as inventory_id', 'items.brand_name as item_brand_name', 'items.qty_1 as item_qty_1', 'items.uom_1 as item_uom_1', 'items.qty_2 as item_qty_2', DB::raw('(SELECT unit_code FROM units WHERE id = items.uom_2) AS item_uom_2'),  'unit_code', 'items.generic_name', DB::raw('SUM(inventory_details.qty) AS Iqty'), DB::raw('     CASE
        //     WHEN SUM(inventory_details.qty) >= (SELECT status_value FROM inventory_statuses WHERE status_name = "In-stock") OR SUM(inventory_details.qty) > (SELECT status_value FROM inventory_statuses WHERE status_name = "Warning") THEN "In Stock"
        //     WHEN SUM(inventory_details.qty) <= (SELECT status_value FROM inventory_statuses WHERE status_name = "Warning") AND SUM(inventory_details.qty) > (SELECT status_value FROM inventory_statuses WHERE status_name = "Out of Stock") THEN "Warning"
        //     ELSE "Out of Stock"
        // END AS inventory_status'), 'expiration_date'))
        //     ->leftJoin("items", "inventory_details.item_id", "=", "items.id")
        //     ->leftJoin("purchase_orders", "purchase_orders.po_number", "=", "inventory_details.po_number")
        //     ->leftJoin("suppliers", "purchase_orders.supplier_id", "=", "suppliers.id")
        //     ->leftJoin("purchase_order_details", "inventory_details.po_number", "=", "purchase_order_details.po_number")
        //     ->leftJoin("units", "units.id", "=", "purchase_order_details.unit_id")
        //     // ->leftJoin("units", function($join)
        //     // {
        //     //     $join->on('units.id', '=', 'items.uom_2');
        //     //     $join->on('units.id','=', 'items.uom_1');
        //     // })
        //     ->orderBy('items.brand_name', 'desc')
        //     ->distinct()
        //     // ->groupBy('inventory_details.item_id')
        //     ->get();
        $inventory = DB::table("inventory_details")
            ->select(
                'inventory_details.item_id as inventory_id',
                'items.brand_name as item_brand_name',
                'items.generic_name',
                'units.unit_code as unicode',
                'inventory_details.unit_price as unit_price',
                'suppliers.supplier_code as supp',
                DB::raw('SUM(inventory_details.qty) AS Iqty'),
                DB::raw('MAX(inventory_details.expiration_date) as expiration_date'), // Latest expiration date
                DB::raw('CASE
                WHEN SUM(inventory_details.qty) >= (SELECT status_value FROM inventory_statuses WHERE status_name = "In-stock") THEN "In Stock"
                WHEN SUM(inventory_details.qty) <= (SELECT status_value FROM inventory_statuses WHERE status_name = "Warning") THEN "Warning"
                ELSE "Out of Stock"
                END AS inventory_status'),
                DB::raw('CASE
                WHEN inventory.item_unit_id = items.uom_1 THEN  SUM(inventory_details.qty) / items.qty_1
                WHEN inventory.item_unit_id = items.uom_2 THEN  SUM(inventory_details.qty) * items.qty_1
                ELSE 0
                END AS converted_qty'),
                DB::raw('CASE
                WHEN inventory.item_unit_id = items.uom_1 THEN (SELECT unit_code from units WHERE id = items.uom_2)
                WHEN inventory.item_unit_id = items.uom_2 THEN (SELECT unit_code from units WHERE id = items.uom_1)
                ELSE "Error"
                END AS converted_uom')
            )
            ->leftJoin("items", "inventory_details.item_id", "=", "items.id")
            ->leftJoin("inventory", "inventory_details.id", "=", "inventory.id")
            ->leftJoin("units", "inventory.item_unit_id", "=", "units.id")
            ->leftJoin("purchase_orders", "inventory_details.po_number", "=", "purchase_orders.po_number")
            ->leftJoin("suppliers", "purchase_orders.supplier_id", "=", "suppliers.id")
            ->groupBy('inventory_details.item_id', 'items.brand_name', 'items.generic_name', 'suppliers.supplier_code')
            ->orderBy('items.brand_name', 'desc')
            ->get();

        // dd($inventory);
        // $inventory = [];

        // $inventory_detail = [];

        return response()->json(['success' => true, 'data' => $inventory]);
    }

    public function get_uom($id)
    {
        $uom = Unit::where('id', $id)->first();

        return response()->json(['success' => true, 'data' => $uom]);
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
