<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $taxes = Tax::all();
        return response()->json(['success' => true, 'data' => $taxes]);
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
    }

    /**
     * Display the specified resource.
     */
    public function show(Tax $tax)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tax $tax)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'effective_from' => 'required|date',
            'effective_to' => 'required|date',
            // Add validation rules for other attributes as needed
        ]);

        $tax = Tax::find($id);

        if (!$tax) {
            return response()->json(['error' => 'Tax not found.'], 404);
        }

        $tax->effective_from = $request->input('effective_from');
        $tax->effective_to = $request->input('effective_to');

        $tax->save();

        return response()->json(['message' => 'Tax updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tax $tax)
    {
        //
    }
}
