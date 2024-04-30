<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Dotenv\Util\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units = Unit::all();
        return response()->json(['success' => true, 'data' => $units]);
    }
    public function unit_by_item_id(string $id)
    {
        $units = DB::table('steritex.items')
            ->select('uom_1', DB::raw('(SELECT unit_code FROM steritex.units WHERE id = uom_1) AS unit_code_1'), 'uom_2', DB::raw('(SELECT unit_code FROM steritex.units WHERE id = uom_2) AS unit_code_2'))
            ->where('items.id', $id)
            ->orderBy('items.uom_1', 'asc')
            ->get();
        $formattedUnits = [];

        foreach ($units as $unit) {
            $formattedUnit = [
                'uom_1' => [
                    'uom' => $unit->uom_1,
                    'unit_code' => $unit->unit_code_1,
                ],
                'uom_2' => [
                    'uom' => $unit->uom_2,
                    'unit_code' => $unit->unit_code_2,
                ],
            ];

            $formattedUnits[] = $formattedUnit;
        }

        return response()->json(['success' => true, 'data' => $formattedUnits]);
    }


    public function unit1_by_item_id(string $id)
    {
        $units = DB::table("items")
            ->select(array('*'))
            ->leftJoin("units", "units.id", "=", "items.uom_1")
            ->where('items.id', $id)
            ->get();

        return response()->json(['success' => true, 'data' => $units]);
    }


    public function unit2_by_item_id(string $id)
    {
        $units = DB::table("items")
            ->select(array('*'))
            ->leftJoin("units", "units.id", "=", "items.uom_2")
            ->where('items.id', $id)
            ->get();

        return response()->json(['success' => true, 'data' => $units]);
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
            'unit_code' => 'required|string|min:3|max:20|unique:units,unit_code',
            'encoded_by' => 'required|integer',
            // Add validation rules for other attributes as needed
        ]);


        $unit = Unit::create($validatedData);

        $newUnit = Unit::find($unit->id);

        return response()->json(['success' => true, 'data' => $newUnit]);
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
            'unit_code' => 'required|string|min:3|max:20',
            'edited_by' => 'required|integer',
            // Add validation rules for other attributes as needed
        ]);

        $unit = Unit::find($id);

        if (!$unit) {
            return response()->json(['error' => 'Unit not found.'], 404);
        }

        $unit->unit_code = $request->input('unit_code');
        $unit->edited_by = $request->input('edited_by');

        $unit->save();

        return response()->json(['message' => 'Unit updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $unit = Unit::find($id);

        if (!$unit) {
            return response()->json(['error' => 'Unit not found.'], 404);
        }

        $unit->delete();

        return response()->json(['message' => 'Unit deleted successfully.']);
    }
}
