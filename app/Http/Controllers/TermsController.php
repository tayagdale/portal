<?php

namespace App\Http\Controllers;

use App\Models\Terms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TermsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $terms = DB::table("terms")
            ->select(
                "terms.*",
                DB::raw("(SELECT calendar FROM calendars WHERE id = terms.calendar_id) as calendar"),
            )
            ->get();
        return response()->json(['success' => true, 'data' => $terms]);
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
            'terms' => 'required|integer',
            'calendar_id' => 'required|integer',
            // Add validation rules for other attributes as needed
        ]);


        $term = Terms::create($validatedData);

        $newTerms = Terms::find($term->id);

        return response()->json(['success' => true, 'data' => $newTerms]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Terms $terms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Terms $terms)
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
            'terms' => 'required|string|min:3|max:20',
            'calendar_id' => 'required|integer',
            // Add validation rules for other attributes as needed
        ]);

        $term = Terms::find($id);

        if (!$term) {
            return response()->json(['error' => 'Term not found.'], 404);
        }

        $term->calendar_id = $request->input('calendar_id');
        $term->terms = $request->input('terms');

        $term->save();

        return response()->json(['message' => 'Term updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $term = Terms::find($id);

        if (!$term) {
            return response()->json(['error' => 'Terms not found.'], 404);
        }

        $term->delete();

        return response()->json(['message' => 'Terms deleted successfully.']);
    }
}
