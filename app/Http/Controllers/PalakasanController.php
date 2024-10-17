<?php

namespace App\Http\Controllers;

use App\Models\AssignedTeams;
use App\Models\Palakasan;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PalakasanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assignedTeams = AssignedTeams::all();
        $palakasans = Palakasan::all();
        // Get the latest Palakasan
        $latestPalakasan = Palakasan::latest()->first();
        return Inertia::render('SSCAdmin/Palakasan/Details',[
            'palakasans' => $palakasans,
            'assignedTeams' => $assignedTeams,
            'latestPalakasan' => $latestPalakasan, // Pass latest Palakasan to the view
        ]);
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
        // Validate the request
        $validated = $request->validate([
            'theme' => 'required|string|max:255',
            'tagline' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required|boolean',
        ]);
        
                // Create a new Palakasan record
        Palakasan::create([
            'year' => date('Y'), // Set the year to the current year
            'theme' => $validated['theme'],
            'tagline' => $validated['tagline'],
            'description' => $validated['description'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'status' => $validated['status'],
        ]);
        
                // Redirect or return a response
        return redirect('/palakasan/details')->with('success', 'Palakasan created successfully.');
           
    }
    public function toggleStatus(Request $request, Palakasan $palakasan)
    {
        // Validate the status field
        $request->validate([
            'status' => 'required|boolean',
        ]);

        // Update the status
        $palakasan->update([
            'status' => $request->status,
        ]);

        // Optionally, return a response
        return redirect()->back()->with('success', 'Palakasan status updated successfully.');
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
