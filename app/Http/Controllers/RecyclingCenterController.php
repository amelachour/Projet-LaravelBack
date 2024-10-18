<?php

namespace App\Http\Controllers;

use App\Models\RecyclingCenter;
use App\Models\Category;
use Illuminate\Http\Request;

class RecyclingCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $centers = RecyclingCenter::with('categories')->get();
        return view('CentreRecyclage.index', compact('centers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('CentreRecyclage.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'min:6', 
                'regex:/^[a-zA-Z\s]+$/', 
            ],
            'location' => 'required|string|max:255',
           'contact_info' => [
                'required',
                'string',
                'max:255',
                'regex:/^\+216\s\d{2}\s\d{3}\s\d{3}$/', 
            ],
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ], [
            'name.regex' => 'Le nom doit contenir uniquement des lettres.',
            'name.min' => 'Le nom doit contenir au moins 6 lettres.',
            'contact_info.regex' => 'Le format du numéro de contact est invalide.',
        ]);


        $center = RecyclingCenter::create($validated);
        $center->categories()->attach($validated['categories']);        
        return redirect()->route('CentreRecyclage.index')->with('success', 'Centre de recyclage créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(RecyclingCenter $recyclingCenter)
    {
        return view('CentreRecyclage.show', compact('recyclingCenter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RecyclingCenter $recyclingCenter)
    {
        $categories = Category::all();
        return view('CentreRecyclage.edit', compact('recyclingCenter', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RecyclingCenter $recyclingCenter)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'min:6', 
                'regex:/^[a-zA-Z\s]+$/', 
            ],
            'location' => 'required|string|max:255',
            'contact_info' => [
                'required',
                'string',
                'max:255',
                'regex:/^\+216\s\d{2}\s\d{3}\s\d{3}$/', 
            ],
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ], [
            'name.regex' => 'Le nom doit contenir uniquement des lettres.',
            'name.min' => 'Le nom doit contenir au moins 6 lettres.',
            'contact_info.regex' => 'Le format du numéro de contact est invalide.',
            'categories.regex' => 'Le categorie est required.',
        ]);


        $recyclingCenter->update($validated);
        $recyclingCenter->categories()->sync($validated['categories']); 
        return redirect()->route('CentreRecyclage.index')->with('success', 'Centre de recyclage mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RecyclingCenter $recyclingCenter)
    {
        $recyclingCenter->delete();
        return redirect()->route('CentreRecyclage.index')->with('success', 'Centre de recyclage supprimé avec succès.');
    }
}