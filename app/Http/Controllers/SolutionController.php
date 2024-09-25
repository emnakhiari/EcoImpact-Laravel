<?php

namespace App\Http\Controllers;

use App\Models\Solution;
use App\Models\Challenge;
use Illuminate\Http\Request;

class SolutionController extends Controller
{
    public function create($challengeId)
    {
        $challenge = Challenge::findOrFail($challengeId);
        return view('solutions.create', compact('challenge'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'challenge_id' => 'required|exists:challenges,id',
        ]);
    
        // Assuming you have a Solution model set up
        Solution::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'challenge_id' => $validatedData['challenge_id'],
            'user_id' => auth()->id(), // Store the logged-in user's ID
        ]);
    
        return redirect()->back()->with('success', 'Solution added successfully!');
    }
 

    public function edit($id)
    {
        $solution = Solution::findOrFail($id);
        return response()->json($solution); // Return as JSON for AJAX
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
        ]);
    
        $solution = Solution::findOrFail($id);
    
        // Update the solution with the validated data
        $solution->update($request->only(['title', 'description']));
    
        // Return JSON response for AJAX success handling
        return response()->json(['success' => 'Solution updated successfully!']);
    }
    
    
    
    public function destroy($id)
    {
        $solution = Solution::findOrFail($id);
        $solution->delete();
        return redirect()->back()->with('success', 'Solution deleted successfully!');
    }



    function voteSolution($solutionId) {
        // Placeholder: Add your voting functionality here
        console.log('Voting for solution with ID:', solutionId);
    }
    
    
}
