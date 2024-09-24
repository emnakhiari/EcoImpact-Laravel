<?php

namespace App\Http\Controllers;
use App\Models\Challenge;

use Illuminate\Http\Request;
class ChallengeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search', '');
        $challenges = Challenge::where('title', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->paginate(10);
    
            if ($request->ajax()) {
                return view('Back.Challenges.table_rows', compact('challenges'));
            }
            
    
        return view('Back.Challenges.index', compact('challenges', 'search'));
    }
    
    

  /*  public function indexfront()
    {
        $challenges = Challenge::all();
        return view('Front.Challenges.index', compact('challengesfront')); // Use the correct path for the view
    }
    */
   
    public function create()
    {
        return view('Back.Challenges.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:500',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'reward_points' => 'required|integer|min:1|max:1000',
            'image' => 'image|nullable|max:2048', // validate image
        ]);
    
        $data = $request->all();
    
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('challenges', 'public'); // Store image in 'public/challenges'
        }
    
        Challenge::create($data);
        return redirect()->route('challenges.index')->with('success', 'Challenge created successfully');
    }
    

    public function show($id)
    {
        $challenge = Challenge::findOrFail($id);
        return view('Back.Challenges.show', compact('challenge'));
    }

    public function edit($id)
    {
        $challenge = Challenge::findOrFail($id);
        return view('Back.Challenges.edit', compact('challenge'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:500',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'reward_points' => 'required|integer|min:1|max:1000',
            'image' => 'image|nullable|max:2048', // Validate image
        ]);
    
        // Find the challenge by ID
        $challenge = Challenge::findOrFail($id);
    
        // Prepare data for updating
        $data = $request->all();
    
        // Check if there's a new image and store it
        if ($request->hasFile('image')) {
            // Store the new image
            $data['image'] = $request->file('image')->store('challenges', 'public');
    
            // Optionally, delete the old image if necessary
            // if ($challenge->image) {
            //     Storage::disk('public')->delete($challenge->image);
            // }
        } else {
            // If no new image is uploaded, keep the old image
            $data['image'] = $challenge->image;
        }
    
        // Update the challenge with the new data
        $challenge->update($data);
    
        return redirect()->route('challenges.index')->with('success', 'Challenge updated successfully');
    }
    

    public function destroy($id)
    {
        $challenge = Challenge::findOrFail($id);
        $challenge->delete();
        return redirect()->route('challenges.index')->with('success', 'Challenge deleted successfully');
    }
}
