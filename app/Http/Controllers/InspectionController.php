<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use NunoMaduro\Collision\Adapters\Laravel\Inspector;

class InspectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inspections = DB::table("inspections")
            ->select(array('inspections.*', 'warehouse_name', 'warehouse_location', 'suppliers.description as supplier', 'purchase_orders.total_amount', 'inspections.status as inspection_status', 'purchase_order_details.qty as pod_qty'))
            ->leftJoin("suppliers", "suppliers.id", "=", "inspections.supplier_id")
            ->leftJoin("purchase_orders", "purchase_orders.po_number", "=", "inspections.po_number")
            ->leftJoin("purchase_order_details", "purchase_order_details.po_number", "=", "inspections.po_number")
            ->leftJoin("warehouse", "inspections.warehouse_id", "=", "warehouse.id")
            ->orderBy('inspections.id', 'desc')
            ->get();
        return response()->json(['success' => true, 'data' => $inspections]);
    }

    public function get_all_active_inspections()
    {

        $inspections = DB::table("inspections")
            ->select("*")
            ->where('status', '=', 1)
            ->get();
        return response()->json(['success' => true, 'data' => $inspections]);
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
            'inspection_number' => 'required|string|min:3|max:20',
            'warehouse_id' => 'required|integer',
            // Add validation rules for other attributes as needed
        ]);

        $purchaseOrder = PurchaseOrder::where('id', $id)->first();

        if (!$purchaseOrder) {
            return response()->json(['error' => 'Purchase order not found.'], 404);
        }

        $inspection = new Inspection();
        $inspection->inspection_number = $request->input('inspection_number');
        $inspection->warehouse_id = $request->input('warehouse_id');
        $inspection->po_number = $purchaseOrder->po_number;
        $inspection->supplier_id = $purchaseOrder->supplier_id;
        $inspection->total_amount = $purchaseOrder->total_amount;
        $inspection->encoded_by = auth()->user()->id;
        // Set other fields...
        $save_inspection = $inspection->save();
        if ($save_inspection) {
            $purchaseOrder->status = 2;
            $update_purchase_order = $purchaseOrder->save();
            if ($update_purchase_order)
                return response()->json(['message' => 'Inspection has been added successfully.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $inspection_number, string $po_number)
    {

        $data = [
            'po_number'  => $po_number,
            'inspection_number'   => $inspection_number,
        ];
        return view('pages/purchasing/inspection_details')->with($data);
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
