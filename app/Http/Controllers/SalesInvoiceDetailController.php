<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesInvoiceDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $sales_invoice_details = DB::table("sales_invoice_details")
            ->select('*')
            ->leftJoin("inventory", "sales_invoice_details.invty_id", "=", "inventory.id")
            ->leftJoin("items", "sales_invoice_details.item_id", "=", "items.id")
            ->leftJoin("units", "sales_invoice_details.unit_id", "=", "units.id")
            ->where("sales_invoice_details.si_number", $id)
            ->get();
        return response()->json(['success' => true, 'data' => $sales_invoice_details]);
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
