<?php

namespace App\Http\Controllers;

use App\Models\IncomingPayment;
use App\Models\SalesInvoice;
use App\Models\SalesOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IncomingPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $incoming_payment = DB::table("incoming_payment")
            ->select(array('*', 'incoming_payment.DATE AS sDate', 'incoming_payment.status as sStatus', 'customers.customer_code as customer'))
            ->leftJoin("customers", "customers.id", "=", "incoming_payment.customer_id")
            ->leftJoin("sales_invoice", "incoming_payment.si_number", "=", "sales_invoice.si_number")
            ->get();
        return response()->json(['success' => true, 'data' => $incoming_payment]);
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
            'or_number' => 'required|string|min:3|max:20',
            // Add validation rules for other attributes as needed
        ]);


        $sales_invoice = SalesInvoice::where('id', $id)->first();

        if (!$sales_invoice) {
            return response()->json(['error' => 'Sales Invoice not found.'], 404);
        }

        $incoming_payment = new IncomingPayment();
        $incoming_payment->or_number = $request->input('or_number');
        $incoming_payment->si_number = $sales_invoice->si_number;
        $incoming_payment->dr_number = $sales_invoice->dr_number;
        $incoming_payment->so_number = $sales_invoice->so_number;
        $incoming_payment->os_number = $sales_invoice->os_number;
        $incoming_payment->customer_id = $sales_invoice->customer_id;
        $incoming_payment->terms = $sales_invoice->terms;
        $incoming_payment->payment_type = $request->input('payment_type');
        $incoming_payment->payment_amount = $request->input('payment_amount');
        $incoming_payment->payment_mode = $request->input('payment_mode');
        $incoming_payment->check_number = $request->input('check_number');
        $incoming_payment->encoded_by = auth()->user()->id;
        // Set other fields...
        $save_incoming_payment = $incoming_payment->save();
        if ($save_incoming_payment) {
            $sales_invoice->status = 2;
            $update_sales_invoice = $sales_invoice->save();
            if ($update_sales_invoice)
                return response()->json(['message' => 'Incoming Payment has been added successfully.']);
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
