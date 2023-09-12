<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $purchase_orders = DB::table("purchase_orders")
            ->select(
                "purchase_orders.*",
                DB::raw("(SELECT description FROM suppliers WHERE id = purchase_orders.supplier_id) as supplier")
            )
            ->get();
        return response()->json(['success' => true, 'data' => $purchase_orders]);
    }

    public function get_all_active_purchase_orders()
    {

        $purchase_orders = DB::table("purchase_orders")
            ->select("*")
            ->where('status', '=', 1)
            ->get();
        return response()->json(['success' => true, 'data' => $purchase_orders]);
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

        return view('pages/purchasing/purchase_order_add')->with('po_number', $id);
    }

    public function createDraft()
    {
        $purchaseOrder = new PurchaseOrder();
        $purchaseOrder->encoded_by = auth()->user()->id; // Set encoded_by
        $purchaseOrder->status = 4; // Set status
        // Set other fields...
        $purchaseOrder->save();

        return redirect()->route('purchase_order_add.show', ['id' => $purchaseOrder->po_number]);
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
            'po_number' => 'required|string',
            'supplier_id' => 'required|integer',
            'terms' => 'required|integer',
            'total_amount' => 'integer',
            // Add validation rules for other attributes as needed
        ]);

        $purchaseOrder = PurchaseOrder::where('po_number', $id)->first();

        if (!$purchaseOrder) {
            return response()->json(['error' => 'Purchase order not found.'], 404);
        }

        $purchaseOrder->po_number = $request->input('po_number');
        $purchaseOrder->supplier_id = $request->input('supplier_id');
        $purchaseOrder->terms = $request->input('terms');
        $purchaseOrder->total_amount = $request->input('total_amount');
        $purchaseOrder->status = 1;

        $purchaseOrder->save();

        return response()->json(['message' => 'Purchase order updated successfully.']);
    }

    public function print_without_inspection(string $po_number)
    {


        $purchaseOrderDetails = DB::table("purchase_order_details")
            ->select(array('purchase_order_details.*', 'units.unit_code', 'items.brand_name'))
            ->leftJoin("items", "purchase_order_details.item_id", "=", "items.id")
            ->leftJoin("units", "items.unit_id", "=", "units.id")
            ->where('po_number', $po_number)
            ->get();

        $purchaseOrders = DB::table("purchase_orders")
            ->select(array('purchase_orders.*', 'suppliers.address', 'suppliers.description'))
            ->leftJoin("suppliers", "purchase_orders.supplier_id", "=", "suppliers.id")
            ->where('po_number', $po_number)
            ->get();

        $data = [
            'po_number'  => $po_number,
            'po_details'  => $purchaseOrderDetails,
            'po'  => $purchaseOrders,
        ];
        return view('pages/purchasing/print_po_without_inspection')->with($data);
    }

    public function print(string $po_number)
    {

        $purchaseOrderDetails = DB::table("purchase_order_details")
            ->select(DB::raw('inspection_details.qty as total_qty, purchase_order_details.*, purchase_order_details.unit_price * inspection_details.qty as unit_total_amount, units.unit_code, items.brand_name'))
            // ->select(array('purchase_order_details.*',  'units.unit_code', 'items.brand_name'))
            ->leftJoin("items", "purchase_order_details.item_id", "=", "items.id")
            ->leftJoin("units", "items.unit_id", "=", "units.id")
            ->leftJoin("inspection_details", "purchase_order_details.po_number", "=", "inspection_details.po_number")
            ->distinct()
            ->where('purchase_order_details.po_number', $po_number)
            ->get();

        // $purchaseOrderDetails = DB::table("purchase_order_details")
        //     ->select(array('purchase_order_details.*', 'units.unit_code', 'items.brand_name'))
        //     ->leftJoin("items", "purchase_order_details.item_id", "=", "items.id")
        //     ->leftJoin("units", "items.unit_id", "=", "units.id")
        //     ->where('po_number', $po_number)
        //     ->get();

        $purchaseOrders = DB::table("purchase_orders")
            ->select(array('purchase_orders.*', 'suppliers.address', 'suppliers.description'))
            ->leftJoin("suppliers", "purchase_orders.supplier_id", "=", "suppliers.id")
            ->where('po_number', $po_number)
            ->get();

        $data = [
            'po_number'  => $po_number,
            'po_details'  => $purchaseOrderDetails,
            'po'  => $purchaseOrders,
        ];
        return view('pages/purchasing/print_purchase_order')->with($data);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
