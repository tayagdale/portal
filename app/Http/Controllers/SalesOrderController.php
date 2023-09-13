<?php

namespace App\Http\Controllers;

use App\Models\OrderSlip;
use App\Models\SalesOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salesOrder = DB::table("sales_orders")
            ->select(array('*', 'sales_orders.DATE AS sDate', 'sales_orders.status as sStatus', 'customers.customer_code as customer'))
            ->leftJoin("customers", "customers.id", "=", "sales_orders.customer_id")
            ->leftJoin("order_slips", "sales_orders.os_number", "=", "order_slips.os_number")
            ->get();
        return response()->json(['success' => true, 'data' => $salesOrder]);
    }

    public function get_all_active_sales_orders()
    {

        $sales_orders = DB::table("sales_orders")
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
            'so_number' => 'required|string|min:3|max:20',
            // Add validation rules for other attributes as needed
        ]);


        $order_slip = OrderSlip::where('id', $id)->first();

        if (!$order_slip) {
            return response()->json(['error' => 'Order Slip not found.'], 404);
        }

        $salesOrder = new SalesOrder();
        $salesOrder->so_number = $request->input('so_number');
        $salesOrder->os_number = $order_slip->os_number;
        $salesOrder->customer_id = $order_slip->customer_id;
        $salesOrder->date = $request->input('date');
        $salesOrder->terms = $order_slip->terms;
        $salesOrder->encoded_by = auth()->user()->id;
        // Set other fields...
        $save_salesOrder = $salesOrder->save();
        if ($save_salesOrder) {
            $order_slip->status = 2;
            $update_order_slip = $order_slip->save();
            if ($update_order_slip)
                return response()->json(['message' => 'Sales Order has been added successfully.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $so_number)
    {

        // $sales_order = SalesOrder::where([
        //     'so_number' => $so_number,
        // ])->first();

        $sales_order = DB::table("sales_orders")
            ->select(array('*', 'sales_orders.DATE AS sDate', 'sales_orders.status as sStatus', 'customers.customer_code as customer'))
            ->leftJoin("customers", "customers.id", "=", "sales_orders.customer_id")
            ->leftJoin("order_slips", "sales_orders.os_number", "=", "order_slips.os_number")
            ->where('sales_orders.so_number', $so_number)
            ->first();

        if (!$sales_order) {
            return response()->json(['error' => 'Sales order not found.'], 404);
        }
        $data = [
            'so_number'  => $so_number,
            'os_number'  => $sales_order->os_number,
            'customer'  => $sales_order->customer,
            'terms'  => $sales_order->terms,
        ];
        return view('pages/sales/sales_order_update')->with($data);
    }


    public function print(string $so_number)
    {
        $salesOrderDetails = DB::table("sales_order_details")
            ->select(array('sales_order_details.*', 'units.unit_code', 'items.brand_name'))
            ->leftJoin("items", "sales_order_details.item_id", "=", "items.id")
            ->leftJoin("units", "sales_order_details.unit_id", "=", "units.id")
            ->where('so_number', $so_number)
            ->get();

        $salesOrders = DB::table("sales_orders")
            ->select(array('sales_orders.*', 'customers.address', 'customers.description'))
            ->leftJoin("customers", "sales_orders.customer_id", "=", "customers.id")
            ->where('so_number', $so_number)
            ->get();

        $data = [
            'so_number'  => $so_number,
            'so_details'  => $salesOrderDetails,
            'so'  => $salesOrders,
        ];
        return view('pages/sales/print_sales_order')->with($data);
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
