<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::orderBy('description', 'ASC')->get();
        return response()->json(['success' => true, 'data' => $customers]);
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
            'customer_code' => 'required|string|min:3|max:255|unique:customers,customer_code',
            'description' => 'required|string|min:3|max:255|unique:customers,description',
            'address' => 'required|string|min:3|max:255',
            'contact_person' => 'required|string|min:3|max:255',
            'position' => 'required|string|min:3|max:255',
            'contact_no' => 'required|string|min:3|max:255',
            'encoded_by' => 'required|integer',
            // Add validation rules for other attributes as needed
        ]);


        $customer = Customer::create($validatedData);

        $newCustomer = Customer::find($customer->id);

        return response()->json(['success' => true, 'data' => $newCustomer]);
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
            'customer_code' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:3|max:255',
            'address' => 'required|string|min:3|max:255',
            'contact_person' => 'required|string|min:3|max:255',
            'position' => 'required|string|min:3|max:255',
            'contact_no' => 'required|string|min:3|max:255',
            'edited_by' => 'required|integer',
            // Add validation rules for other attributes as needed
        ]);

        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json(['error' => 'Customer not found.'], 404);
        }

        $customer->customer_code = $request->input('customer_code');
        $customer->description = $request->input('description');
        $customer->address = $request->input('address');
        $customer->contact_person = $request->input('contact_person');
        $customer->position = $request->input('position');
        $customer->contact_no = $request->input('contact_no');
        $customer->edited_by = $request->input('edited_by');

        $customer->save();

        return response()->json(['message' => 'Customer updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json(['error' => 'Customer not found.'], 404);
        }

        $customer->delete();

        return response()->json(['message' => 'Customer deleted successfully.']);
    }
}
