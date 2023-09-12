<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return response()->json(['success' => true, 'data' => $suppliers]);
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
        $validatedData = $request->validate([
            'supplier_code' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:3|max:255',
            'address' => 'required|string|min:3|max:255',
            'contact_person' => 'required|string|min:3|max:255',
            'position' => 'required|string|min:3|max:255',
            'contact_no' => 'required|string|min:3|max:255',
            'encoded_by' => 'required|integer',
            // Add validation rules for other attributes as needed
        ]);


        $supplier = Supplier::create($validatedData);

        $newSupplier = Supplier::find($supplier->id);

        return response()->json(['success' => true, 'data' => $newSupplier]);
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
        // Validate the input data from the edit form
        $request->validate([
            'supplier_code' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:3|max:255',
            'address' => 'required|string|min:3|max:255',
            'contact_person' => 'required|string|min:3|max:255',
            'position' => 'required|string|min:3|max:255',
            'contact_no' => 'required|string|min:3|max:255',
            'edited_by' => 'required|integer',
            // Add validation rules for other attributes as needed
        ]);

        $supplier = Supplier::find($id);

        if (!$supplier) {
            return response()->json(['error' => 'Supplier not found.'], 404);
        }

        $supplier->supplier_code = $request->input('supplier_code');
        $supplier->description = $request->input('description');
        $supplier->address = $request->input('address');
        $supplier->contact_person = $request->input('contact_person');
        $supplier->position = $request->input('position');
        $supplier->contact_no = $request->input('contact_no');
        $supplier->edited_by = $request->input('edited_by');

        $supplier->save();

        return response()->json(['message' => 'Supplier updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::find($id);

        if (!$supplier) {
            return response()->json(['error' => 'Supplier not found.'], 404);
        }

        $supplier->delete();

        return response()->json(['message' => 'Supplier deleted successfully.']);
    }
}
