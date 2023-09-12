<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Models\OutgoingPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OutgoingPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $outgoing_payment = DB::table("outgoing_payment")
            ->select(array('*', 'outgoing_payment.DATE AS sDate', 'outgoing_payment.status as sStatus', 'suppliers.supplier_code as supplier'))
            ->leftJoin("suppliers", "suppliers.id", "=", "outgoing_payment.supplier_id")
            ->leftJoin("inspections", "outgoing_payment.inspection_number", "=", "inspections.inspection_number")
            ->get();
        return response()->json(['success' => true, 'data' => $outgoing_payment]);
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
    public function store(Request $request, string $id)
    {

        $request->validate([
            'por_number' => 'required|string|min:3|max:20',
            // Add validation rules for other attributes as needed
        ]);


        $inspection = Inspection::where('id', $id)->first();

        if (!$inspection) {
            return response()->json(['error' => 'Sales Invoice not found.'], 404);
        }

        $outgoing_payment = new OutgoingPayment();
        $outgoing_payment->por_number = $request->input('por_number');
        $outgoing_payment->inspection_number = $inspection->inspection_number;
        $outgoing_payment->po_number = $inspection->po_number;
        $outgoing_payment->supplier_id = $inspection->supplier_id;
        $outgoing_payment->total_amount = $inspection->total_amount;
        $outgoing_payment->payment_type = $request->input('payment_type');
        $outgoing_payment->payment_amount = $request->input('payment_amount');
        $outgoing_payment->payment_mode = $request->input('payment_mode');
        $outgoing_payment->check_number = $request->input('check_number');
        $outgoing_payment->encoded_by = auth()->user()->id;
        // Set other fields...
        $save_outgoing_payment = $outgoing_payment->save();
        if ($save_outgoing_payment) {
            $inspection->status = 2;
            $update_inspection = $inspection->save();
            if ($update_inspection)
                return response()->json(['message' => 'Outgoing Payment has been added successfully.']);
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
