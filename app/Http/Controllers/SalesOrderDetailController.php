<?php

namespace App\Http\Controllers;

use App\Models\InventoryDetail;
use App\Models\SalesOrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesOrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $sales_order_details = DB::table("sales_order_details")
            ->select('*')
            ->leftJoin("inventory", "sales_order_details.invty_id", "=", "inventory.id")
            ->leftJoin("items", "sales_order_details.item_id", "=", "items.id")
            ->leftJoin("units", "sales_order_details.unit_id", "=", "units.id")
            ->where("sales_order_details.so_number", $id)
            ->get();
        return response()->json(['success' => true, 'data' => $sales_order_details]);
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
            'so_number' => 'required|string|min:3|max:20',
            'os_number' => 'required|string|min:3|max:20',
            'qty' => 'required|integer',
            'item_id' => 'required|integer',
            'invty_id' => 'required|integer',
            'unit_id' => 'required|integer',
            'expiration_date' => 'required|date',
            'lot_no' => 'required|string|min:3|max:255',
            'unit_price' => 'required|numeric',
            // Add validation rules for other attributes as needed
        ]);


        $sales_order_detail = SalesOrderDetail::create($validatedData);

        $newSales_order_detail = SalesOrderDetail::find($sales_order_detail->id);

        if (!$newSales_order_detail) {
            return response()->json(['error' => 'Sales order detail not found.'], 404);
        }

        $inventory_detail = InventoryDetail::where([
            'id' => $request->input('invty_id')
        ])->first();
        if ($inventory_detail) {
            $inventory_detail->qty = 0;
            $save_inventory_detail = $inventory_detail->save();
            if ($save_inventory_detail) {
                return response()->json(['success' => true, 'data' => $newSales_order_detail]);
            }
        }
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
