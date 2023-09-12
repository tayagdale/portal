<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\SalesInvoice;
use App\Models\SalesInvoiceDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales_invoice = DB::table("sales_invoice")
            ->select(array('*', 'sales_invoice.DATE AS sDate', 'sales_invoice.id AS sId', 'sales_invoice.status as sStatus', 'customers.customer_code as customer'))
            ->leftJoin("customers", "customers.id", "=", "sales_invoice.customer_id")
            ->leftJoin("delivery", "sales_invoice.dr_number", "=", "delivery.dr_number")
            ->get();
        return response()->json(['success' => true, 'data' => $sales_invoice]);
    }

    public function get_all_active_sales_invoices()
    {

        $sales_invoice = DB::table("sales_invoice")
            ->select("*")
            ->where('status', '=', 1)
            ->get();
        return response()->json(['success' => true, 'data' => $sales_invoice]);
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
            'si_number' => 'required|string|min:3|max:20',
            // Add validation rules for other attributes as needed
        ]);


        $delivery = Delivery::where('id', $id)->first();

        if (!$delivery) {
            return response()->json(['error' => 'Delivery not found.'], 404);
        }

        $sales_invoice = new SalesInvoice();
        $sales_invoice->si_number = $request->input('si_number');
        $sales_invoice->dr_number = $delivery->dr_number;
        $sales_invoice->so_number = $delivery->so_number;
        $sales_invoice->os_number = $delivery->os_number;
        $sales_invoice->customer_id = $delivery->customer_id;
        $sales_invoice->terms = $delivery->terms;
        $sales_invoice->encoded_by = auth()->user()->id;
        // Set other fields...
        $save_sales_invoice = $sales_invoice->save();


        $delivery_details = DB::table("delivery_details")
            ->select("*")
            ->where('dr_number', '=', $sales_invoice->dr_number)
            ->get();


        foreach ($delivery_details as $delivery_detail) {
            $sales_invoice_detail = new SalesInvoiceDetail();

            $sales_invoice_detail->si_number = $sales_invoice->si_number;
            $sales_invoice_detail->dr_number = $delivery_detail->dr_number;
            $sales_invoice_detail->so_number = $delivery_detail->so_number;
            $sales_invoice_detail->os_number = $delivery_detail->os_number;
            $sales_invoice_detail->invty_id = $delivery_detail->invty_id;
            $sales_invoice_detail->item_id = $delivery_detail->item_id;
            $sales_invoice_detail->qty = $delivery_detail->qty;
            $sales_invoice_detail->unit_id = $delivery_detail->unit_id;
            $sales_invoice_detail->lot_no = $delivery_detail->lot_no;
            $sales_invoice_detail->expiration_date = $delivery_detail->expiration_date;
            $sales_invoice_detail->unit_price = $delivery_detail->unit_price;

            $sales_invoice_detail->save();
        }



        if ($save_sales_invoice) {
            $delivery->status = 2;
            $update_delivery = $delivery->save();
            if ($update_delivery)
                return response()->json(['message' => 'Sales Invoice has been added successfully.']);
        }
    }

    public function print(string $si_number)
    {
        $salesInvoiceDetails = DB::table("sales_invoice_details")
            ->select(array('sales_invoice_details.*', 'units.unit_code', 'items.brand_name'))
            ->leftJoin("items", "sales_invoice_details.item_id", "=", "items.id")
            ->leftJoin("units", "items.unit_id", "=", "units.id")
            ->where('si_number', $si_number)
            ->get();

        $sales_invoice = DB::table("sales_invoice")
            ->select(array('sales_invoice.*', 'customers.address', 'customers.description', 'customers.customer_code'))
            ->leftJoin("customers", "sales_invoice.customer_id", "=", "customers.id")
            ->where('si_number', $si_number)
            ->get();

        $data = [
            'si_number'  => $si_number,
            'si_details'  => $salesInvoiceDetails,
            'si'  => $sales_invoice,
        ];
        return view('pages/sales/print_sales_invoice')->with($data);
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
