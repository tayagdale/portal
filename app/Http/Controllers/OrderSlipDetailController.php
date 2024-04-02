<?php

namespace App\Http\Controllers;

use App\Models\OrderSlipDetail;
use Dotenv\Util\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderSlipDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $order_slip_details = DB::table("order_slip_details")
            ->select(array('*', 'order_slip_details.id as id'))
            ->leftJoin("items", "order_slip_details.item_id", "=", "items.id")
            ->leftJoin("units", "order_slip_details.unit_id", "=", "units.id")
            ->where("order_slip_details.os_number", $id)
            ->get();
        return response()->json(['success' => true, 'data' => $order_slip_details]);
    }

    public function get_total_qty(string $id)
    {
        $order_slip_details = DB::table("order_slip_details")
            ->select(DB::raw('SUM(qty) AS qty, unit_code'))
            ->leftJoin("units", "order_slip_details.unit_id", "=", "units.id")
            ->where("order_slip_details.os_number", $id)
            ->get();
        return response()->json(['success' => true, 'data' => $order_slip_details]);
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
    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'os_number' => 'required|string|min:3|max:20',
    //         'qty' => 'required|integer',
    //         'unit_id' => 'required|integer',
    //         'item_id' => 'required|integer',
    //         // Add validation rules for other attributes as needed
    //     ]);


    //     $order_slip_detail = OrderSlipDetail::create($validatedData);

    //     $neworder_slip_detail = OrderSlipDetail::find($order_slip_detail->id);

    //     return response()->json(['success' => true, 'data' => $neworder_slip_detail]);
    // }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'os_number' => 'required|string|min:3|max:20',
            'qty' => 'required|integer',
            'unit_id' => 'required|integer',
            'item_id' => 'required|integer',
            // Add validation rules for other attributes as needed
        ]);

        // Check if an OrderSlipDetail with the same os_number and item_id already exists
        $order_slip_detail = OrderSlipDetail::where('os_number', $validatedData['os_number'])
            ->where('item_id', $validatedData['item_id'])
            ->where('unit_id', $validatedData['unit_id'])
            ->first();

        if ($order_slip_detail) {
            // If it exists, update the qty
            $order_slip_detail->qty += $validatedData['qty'];
            $order_slip_detail->save();
        } else {
            // If it doesn't exist, create a new record
            $order_slip_detail = OrderSlipDetail::create($validatedData);
        }

        return response()->json(['success' => true, 'data' => $order_slip_detail]);
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
            'qty' => 'required|numeric',
            // Add validation rules for other attributes as needed
        ]);

        $orderSlipDetail = OrderSlipDetail::find($id);

        if (!$orderSlipDetail) {
            return response()->json(['error' => 'Order Slip Detail not found.'], 404);
        }

        $orderSlipDetail->qty = $request->input('qty');

        $orderSlipDetail->save();

        return response()->json(['message' => 'Order Slip Detail updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $orderSlipDetail = OrderSlipDetail::find($id);

        if (!$orderSlipDetail) {
            return response()->json(['error' => 'Order Slip Detail not found.'], 404);
        }

        $orderSlipDetail->delete();

        return response()->json(['message' => 'Order Slip Detail deleted successfully.']);
    }

    public function clear(string $id)
    {
        $purchaseOrderDetail = DB::table('order_slip_details')->where('os_number', $id);
        $purchaseOrderDetail->delete();

        return response()->json(['message' => 'Order Slip Detail has been cleared successfully.']);
    }
}
