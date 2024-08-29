<?php

namespace App\Http\Controllers;

use App\Models\InventoryDetail;
use App\Models\Item;
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
            ->select('*', 'sales_order_details.id as sodID')
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
            'remarks' => 'nullable|string'
            // Add validation rules for other attributes as needed
        ]);

        // Check if an OrderSlipDetail with the same os_number and item_id already exists
        $sales_order_detail = SalesOrderDetail::where('so_number', $validatedData['so_number'])
            ->where('invty_id', $validatedData['invty_id'])
            ->where('item_id', $validatedData['item_id'])
            ->first();

        if ($sales_order_detail) {
            // If it exists, update the qty
            $sales_order_detail->qty += $validatedData['qty'];
            $sales_order_detail->save();

            $inventory_detail = InventoryDetail::where([
                'id' => $request->input('invty_id')
            ])->first();

            $get_current_item = Item::where('id', $request->input('item_id'))->first();

            if (!$get_current_item) {
                return response()->json(['error' => 'Item not found.'], 404);
            }
            $qty = $request->input('qty');

            if (!empty($get_current_item->uom_2)) {
                $qty = $request->input('qty') * $get_current_item->qty_2;
            }

            if ($inventory_detail) {
                $inventory_detail->qty = $inventory_detail->qty - $qty;
                $save_inventory_detail = $inventory_detail->save();
                if ($save_inventory_detail) {
                    return response()->json(['success' => true]);
                }
            }
        } else {
            // If it doesn't exist, create a new record
            $sales_order_detail = SalesOrderDetail::create($validatedData);

            $newSales_order_detail = SalesOrderDetail::find($sales_order_detail->id);

            if (!$newSales_order_detail) {
                return response()->json(['error' => 'Sales order detail not found.'], 404);
            }

            $inventory_detail = InventoryDetail::where([
                'id' => $request->input('invty_id')
            ])->first();


            $get_current_item = Item::where('id', $request->input('item_id'))->first();

            if (!$get_current_item) {
                return response()->json(['error' => 'Item not found.'], 404);
            }
            $qty = $request->input('qty');

            if (!empty($get_current_item->uom_2)) {
                $qty = $request->input('qty') * $get_current_item->qty_2;
            }

            if ($inventory_detail) {
                $inventory_detail->qty = $inventory_detail->qty - $qty;
                $save_inventory_detail = $inventory_detail->save();
                if ($save_inventory_detail) {
                    return response()->json(['success' => true, 'data' => $newSales_order_detail]);
                }
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
        $salesOrderDetail = SalesOrderDetail::find($id);

        if (!$salesOrderDetail) {
            return response()->json(['error' => 'Sales Order Detail not found.'], 404);
        }
        $inventory_detail = InventoryDetail::where([
            'id' => $salesOrderDetail->invty_id
        ])->first();

        if ($inventory_detail) {

            $get_current_item = Item::where('id', $salesOrderDetail->item_id)->first();

            if (!$get_current_item) {
                return response()->json(['error' => 'Item not found.'], 404);
            }
            $qty = $salesOrderDetail->qty;

            if (!empty($get_current_item->uom_2)) {
                $qty = $salesOrderDetail->qty * $get_current_item->qty_2;
            }


            $inventory_detail->qty = $inventory_detail->qty + $qty;
            $save_inventory_detail = $inventory_detail->save();
            if ($save_inventory_detail) {
                $salesOrderDetail->delete();
                return response()->json(['success' => true]);
            }
        }

        return response()->json(['message' => 'Sales Order Detail deleted successfully.']);
    }
}
