<?php

namespace App\Http\Controllers;

use App\Models\AssignedSports;
use App\Models\AssignedTeams;
use App\Models\College;
use App\Models\Palakasan;
use App\Models\Sport;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OnePalakasanController extends Controller
{
    public function details()
    {   
        $sports = Sport::all();
        $colleges = College::all();

        // Fetch the latest Palakasan
        $latestPalakasan = Palakasan::latest()->first();        

        // Initialize empty collections for assigned sports and teams
        $assignedSports = collect();
        $assignedTeams = collect();

        // If a Palakasan exists, fetch the assigned sports and teams
        if ($latestPalakasan) {
            $assignedSports = AssignedSports::with('sport')
                ->where('palakasan_sport_id', $latestPalakasan->id)
                ->get();

            $assignedTeams = AssignedTeams::with('college')
                ->where('palakasan_id', $latestPalakasan->id)
                ->get();
        }
        
        $palakasans = Palakasan::all();

        return Inertia::render('SSCAdmin/Onepalakasan', [
            'colleges' => $colleges,
            'sports' => $sports,
            'palakasans' => $palakasans,
            'assignedSports' => $assignedSports,
            'assignedTeams' => $assignedTeams,
            'latestPalakasan' => $latestPalakasan, // Pass the latest Palakasan (could be null) to the view
        ]);
    }

    public function store_palakasan(Request $request)
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
        return redirect('/details')->with('success', 'Palakasan created successfully.');
           
    }

    public function store_sports(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'palakasan_sport_id' => 'required|exists:palakasans,id', // Added palakasan_sport_id validation
            'sport_id' => 'required|exists:sports,id',
            'categories' => 'required|string|in:Men,Women,Mixed',
            'setup' => 'required|string|in:Double Elimination,Single Elimination,Free for All',
        ]);
    
        // Store the validated data in the database
        AssignedSports::create([
            'palakasan_sport_id' => $validated['palakasan_sport_id'], // Ensure this matches the form field name
            'sport_id' => $validated['sport_id'],
            'categories' => $validated['categories'],
            'setup' => $validated['setup'],
        ]);
    
        return redirect()->back()->with('success', 'Team assigned to the sport successfully.');
    }

    public function store_teams(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'assigned_team_name' => 'required|string|max:255',
            'college_id' => 'required|exists:colleges,id',
            'palakasan_id' => 'required|exists:palakasans,id',
        ], [
            'assigned_team_name.required' => 'The team name is required.',
            'college_id.exists' => 'The selected college does not exist.',
            'palakasan_id.exists' => 'The selected Palakasan does not exist.',
        ]);

        // Create a new assigned team
        AssignedTeams::create($validated);

        // Return a success response or redirect
        return redirect('/palakasan/team')->with('success', 'Team created successfully!');
    }

    //status
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|boolean',
        ]);

        $palakasan = Palakasan::findOrFail($id);
        $palakasan->status = $request->status;
        $palakasan->save();

        return redirect()->back()->with('success', 'Palakasan status updated successfully.');
    }
}
