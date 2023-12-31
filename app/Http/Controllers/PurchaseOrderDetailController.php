<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseOrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $purchase_order_details = DB::table("purchase_order_details")
            ->select(array('*', 'purchase_order_details.id as id'))
            ->leftJoin("items", "purchase_order_details.item_id", "=", "items.id")
            ->leftJoin("units", "purchase_order_details.unit_id", "=", "units.id")
            ->where("purchase_order_details.po_number", $id)
            ->get();
        return response()->json(['success' => true, 'data' => $purchase_order_details]);
    }

    public function get_total_amount(string $id)
    {
        $purchase_order_details = DB::table("purchase_order_details")
            ->select(DB::raw('SUM(total_amount) AS total'))
            ->where("purchase_order_details.po_number", $id)
            ->get();
        return response()->json(['success' => true, 'data' => $purchase_order_details]);
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
            'po_number' => 'required|string|min:3|max:20',
            'qty' => 'required|integer',
            'unit_id' => 'required|integer',
            'unit_price' => 'required|numeric',
            'total_amount' => 'required|numeric',
            'remarks' => 'required|string|min:3|max:255',
            'item_id' => 'required|integer',
            // Add validation rules for other attributes as needed
        ]);

        // Check if an PurchaseOrderDetail with the same os_number and item_id already exists
        $purchase_order_detail = PurchaseOrderDetail::where('po_number', $validatedData['po_number'])
            ->where('item_id', $validatedData['item_id'])
            ->where('unit_id', $validatedData['unit_id'])
            ->where('unit_price', $validatedData['unit_price'])
            ->first();

        if ($purchase_order_detail) {
            // If it exists, update the qty
            $purchase_order_detail->qty += $validatedData['qty'];
            $purchase_order_detail->total_amount = $purchase_order_detail->qty *  $purchase_order_detail->unit_price;
            $purchase_order_detail->save();
        } else {
            // If it doesn't exist, create a new record
            $purchase_order_detail = PurchaseOrderDetail::create($validatedData);
        }


        return response()->json(['success' => true, 'data' => $purchase_order_detail]);
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
            'total_amount' => 'required|numeric',
            'qty' => 'required|numeric',
            'unit_price' => 'required|numeric',
            // Add validation rules for other attributes as needed
        ]);

        $purchaseOrderDetail = PurchaseOrderDetail::find($id);

        if (!$purchaseOrderDetail) {
            return response()->json(['error' => 'Purchase Order Detail not found.'], 404);
        }

        $purchaseOrderDetail->total_amount = $request->input('total_amount');
        $purchaseOrderDetail->qty = $request->input('qty');
        $purchaseOrderDetail->unit_price = $request->input('unit_price');

        $purchaseOrderDetail->save();

        return response()->json(['message' => 'Purchase Order Detail updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $purchaseOrderDetail = PurchaseOrderDetail::find($id);

        if (!$purchaseOrderDetail) {
            return response()->json(['error' => 'Purchase Order Detail not found.'], 404);
        }

        $purchaseOrderDetail->delete();

        return response()->json(['message' => 'Purchase Order Detail deleted successfully.']);
    }


    public function clear(string $id)
    {
        $purchaseOrderDetail = DB::table('purchase_order_details')->where('po_number', $id);
        $purchaseOrderDetail->delete();

        return response()->json(['message' => 'Purchase Order Detail has been cleared successfully.']);
    }
}
