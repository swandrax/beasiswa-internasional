<?php

namespace App\Http\Controllers;

use App\Models\Scholarship;
use Illuminate\Http\Request;

class ScholarshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Scholarship::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'provider' => 'required|string|max:255',
            'deadline' => 'required|date',
            'status' => 'in:open,closed,on_hold',
        ]);

        $scholarship = Scholarship::create($validated);
        
        \App\Events\ScholarshipUpdated::dispatch($scholarship, 'created');

        return response()->json($scholarship, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Scholarship $scholarship)
    {
        return response()->json($scholarship);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Scholarship $scholarship)
    {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'provider' => 'sometimes|string|max:255',
            'deadline' => 'sometimes|date',
            'status' => 'sometimes|in:open,closed,on_hold',
        ]);

        $scholarship->update($validated);
        
        \App\Events\ScholarshipUpdated::dispatch($scholarship, 'updated');

        return response()->json($scholarship);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Scholarship $scholarship)
    {
        $scholarship->delete();
        
        \App\Events\ScholarshipUpdated::dispatch($scholarship, 'deleted');

        return response()->json(null, 204);
    }
}
