<?php

namespace App\Http\Controllers;

use App\Models\InspectionDetail;
use App\Models\Inventory;
use App\Models\InventoryDetail;
use App\Models\Item;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InspectionDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $inspectionDetails = DB::table("purchase_order_details")

            ->select(array('purchase_order_details.*', 'items.*', 'units.*', 'purchase_order_details.id AS id', 'purchase_order_details.qty as purchase_order_qty', 'items.id AS item_id'))
            ->leftJoin("items", "purchase_order_details.item_id", "=", "items.id")
            ->leftJoin("units", "purchase_order_details.unit_id", "=", "units.id")
            ->where('purchase_order_details.po_number', $id)
            ->get();
        return response()->json(['success' => true, 'data' => $inspectionDetails]);
    }


    /**
     * Display a listing of the resource.
     */
    public function view_inspection_detail(string $id, int $item_id)
    {
        $inspectionDetails = DB::table("inspection_details")
            ->select('*', 'users.name as user_name')
            ->leftJoin("items", "inspection_details.item_id", "=", "items.id")
            ->leftJoin("users", "inspection_details.inspect_by", "=", "users.id")
            ->where('inspection_details.po_number', $id)
            ->where('inspection_details.item_id', $item_id)
            ->get();

        // dd($inspectionDetails);
        return response()->json(['success' => true, 'data' => $inspectionDetails]);
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
        $request->validate([
            'inspection_number' => 'required|string|min:3|max:20',
            'po_number' => 'required|string|min:3|max:20',
            'item_id' => 'required|integer',
            'qty' => 'required|integer',
            'unit_price' => 'required',
            'delivery_date' => 'required|date',
            'lot_no' => 'required|string|min:3|max:255',
            'expiration_date' => 'required|date',
            'inspect_by' => 'required|integer',
            // Add validation rules for other attributes as needed
        ]);


        // $PurchaseOrderDetail = PurchaseOrderDetail::create($validatedData);

        // $newPurchaseOrderDetail = PurchaseOrderDetail::find($PurchaseOrderDetail->id);





        // return response()->json(['success' => true, 'data' => $newPurchaseOrderDetail]);

        $inspection = new InspectionDetail();

        $inspection->inspection_number = $request->input('inspection_number');
        $inspection->po_number = $request->input('po_number');
        $inspection->item_id = $request->input('item_id');
        $inspection->qty = $request->input('qty');
        $inspection->delivery_date = $request->input('delivery_date');
        $inspection->lot_no = $request->input('lot_no');
        $inspection->expiration_date = $request->input('expiration_date');
        $inspection->inspect_by = auth()->user()->id;

        $save_inspection = $inspection->save();

        if ($save_inspection) {
            $purchase_order_detail = PurchaseOrderDetail::where([
                'po_number' => $request->input('po_number'),
                'item_id' => $request->input('item_id')
            ])->first();

            if (!$purchase_order_detail) {
                return response()->json(['error' => 'Purchase order not found.'], 404);
            }

            $productId = $purchase_order_detail->id;
            $qty_to_deduct = $request->input('qty');
            $original_qty = $purchase_order_detail->qty;
            $qty_left = $original_qty - $qty_to_deduct;
            $unit_price = $purchase_order_detail->unit_price;
            $new_total = $qty_left * $unit_price;


            $purchase_order_detail->qty = $qty_left;
            $purchase_order_detail->total_amount = $new_total;
            $update_purchase_order_detail = $purchase_order_detail->save();
            if ($update_purchase_order_detail) {

                $get_current_item = Item::where('id', $request->input('item_id'))->first();

                if (!$get_current_item) {
                    return response()->json(['error' => 'Item not found.'], 404);
                }

                $qty = $request->input('qty');

                if (!empty($get_current_item->uom_2)) {
                    $qty = $request->input('qty') * $get_current_item->qty_2;
                }


                $inventory = new Inventory();
                $inventory->item_id = $request->input('item_id');
                $inventory->item_brand_name = $get_current_item->brand_name;
                $inventory->item_category_id = $get_current_item->category_id;
                $inventory->item_unit_id = $purchase_order_detail->unit_id;

                $save_inventory = $inventory->save();

                if ($save_inventory) {
                    $inventory_detail = new InventoryDetail();
                    $inventory_detail->po_number = $request->input('po_number');
                    $inventory_detail->item_id =  $request->input('item_id');
                    $inventory_detail->qty =  $qty;
                    $inventory_detail->unit_price = $request->input('unit_price');
                    $inventory_detail->lot_no =  $request->input('lot_no');
                    $inventory_detail->expiration_date =  $request->input('expiration_date');
                    $inventory_detail->inspection_date = date('Y-m-d H:i:s');
                    $inventory_detail->encoded_by = auth()->user()->id;

                    $save_inventory_detail = $inventory_detail->save();

                    if ($save_inventory_detail)
                        return response()->json(['message' => 'Inventory has been added successfully.']);
                }
            }
        }



        // Set other fields...

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
