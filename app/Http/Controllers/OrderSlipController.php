<?php

namespace App\Http\Controllers;

use App\Models\OrderSlip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderSlipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $order_slips = DB::table("order_slips")
            ->select(
                "order_slips.*",
                DB::raw("(SELECT description FROM customers WHERE id = order_slips.customer_id) as customer")
            )
            ->get();
        return response()->json(['success' => true, 'data' => $order_slips]);
    }

    public function get_all_active_order_slips()
    {

        $order_slips = DB::table("order_slips")
            ->select("*")
            ->where('status', '=', 1)
            ->get();
        return response()->json(['success' => true, 'data' => $order_slips]);
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
        return view('pages/sales/order_slip_add')->with('os_number', $id);
    }

    public function createDraft()
    {
        $order_slips = new OrderSlip();
        $order_slips->encoded_by = auth()->user()->id; // Set encoded_by
        $order_slips->status = 4; // Set status
        // Set other fields...
        $order_slips->save();

        return redirect()->route('order_slip_add.show', ['id' => $order_slips->os_number]);
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
        // Validate the input data from the edit form
        $request->validate([
            'os_number' => 'required|string',
            'customer_id' => 'required|integer',
            'terms' => 'required|integer',
            // Add validation rules for other attributes as needed
        ]);

        $orderSlip = OrderSlip::where('os_number', $id)->first();

        if (!$orderSlip) {
            return response()->json(['error' => 'Order slip not found.'], 404);
        }

        $orderSlip->os_number = $request->input('os_number');
        $orderSlip->customer_id = $request->input('customer_id');
        $orderSlip->terms = $request->input('terms');
        $orderSlip->status = 1;

        $orderSlip->save();

        return response()->json(['message' => 'Order slip updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
