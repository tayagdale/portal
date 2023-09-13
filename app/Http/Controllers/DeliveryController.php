<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\DeliveryDetail;
use App\Models\SalesOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salesOrder = DB::table("delivery")
            ->select(array('*', 'delivery.DATE AS sDate', 'delivery.id as dId', 'delivery.status as sStatus', 'customers.customer_code as customer'))
            ->leftJoin("customers", "customers.id", "=", "delivery.customer_id")
            ->leftJoin("sales_orders", "delivery.so_number", "=", "sales_orders.so_number")
            ->get();
        return response()->json(['success' => true, 'data' => $salesOrder]);
    }


    public function get_all_active_deliveries()
    {

        $sales_orders = DB::table("delivery")
            ->select("*")
            ->where('status', '=', 1)
            ->get();
        return response()->json(['success' => true, 'data' => $sales_orders]);
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
            'dr_number' => 'required|string|min:3|max:20',
            // Add validation rules for other attributes as needed
        ]);



        $sales_order = SalesOrder::where('id', $id)->first();

        if (!$sales_order) {
            return response()->json(['error' => 'Sales Order not found.'], 404);
        }

        $delivery = new Delivery();
        $delivery->dr_number = $request->input('dr_number');
        $delivery->so_number = $sales_order->so_number;
        $delivery->os_number = $sales_order->os_number;
        $delivery->customer_id = $sales_order->customer_id;
        $delivery->terms = $sales_order->terms;
        $delivery->encoded_by = auth()->user()->id;
        // Set other fields...
        $save_delivery = $delivery->save();


        $sales_order_details = DB::table("sales_order_details")
            ->select("*")
            ->where('so_number', '=', $sales_order->so_number)
            ->get();


        foreach ($sales_order_details as $sales_order_detail) {
            $delivery_detail = new DeliveryDetail();

            $delivery_detail->dr_number = $delivery->dr_number;
            $delivery_detail->so_number = $sales_order_detail->so_number;
            $delivery_detail->os_number = $sales_order_detail->os_number;
            $delivery_detail->invty_id = $sales_order_detail->invty_id;
            $delivery_detail->item_id = $sales_order_detail->item_id;
            $delivery_detail->qty = $sales_order_detail->qty;
            $delivery_detail->unit_id = $sales_order_detail->unit_id;
            $delivery_detail->lot_no = $sales_order_detail->lot_no;
            $delivery_detail->expiration_date = $sales_order_detail->expiration_date;
            $delivery_detail->unit_price = $sales_order_detail->unit_price;

            $delivery_detail->save();
        }

        if ($save_delivery) {
            $sales_order->status = 2;
            $update_sales_order = $sales_order->save();
            if ($update_sales_order)
                return response()->json(['message' => 'Delivery has been added successfully.']);
        }
    }


    public function print(string $dr_number)
    {
        $deliveryDetails = DB::table("delivery_details")
            ->select(array('delivery_details.*', 'units.unit_code', 'items.brand_name'))
            ->leftJoin("items", "delivery_details.item_id", "=", "items.id")
            ->leftJoin("units", "delivery_details.unit_id", "=", "units.id")
            ->where('dr_number', $dr_number)
            ->get();

        $deliveries = DB::table("delivery")
            ->select(array('delivery.*', 'customers.address', 'customers.description', 'customers.customer_code'))
            ->leftJoin("customers", "delivery.customer_id", "=", "customers.id")
            ->where('dr_number', $dr_number)
            ->get();

        $data = [
            'dr_number'  => $dr_number,
            'dr_details'  => $deliveryDetails,
            'dr'  => $deliveries,
        ];
        return view('pages/sales/print_delivery')->with($data);
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
