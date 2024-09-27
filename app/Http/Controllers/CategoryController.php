<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('CategorieCentre.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('CategorieCentre.create');
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
                'min:3', 
                'regex:/^[a-zA-Z\s]+$/', 
                'unique:categories'
            ],
        ], [
            'name.regex' => 'Le nom doit contenir uniquement des lettres.',
            'name.min' => 'Le nom doit contenir au moins 3 lettres.',
        ]);

        Category::create($validated);
        return redirect()->route('CategorieCentre.index')->with('success', 'Catégorie créée avec succès.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('CategorieCentre.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('CategorieCentre.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'min:3', 
                'regex:/^[a-zA-Z\s]+$/', 
                'unique:categories,name,' . $category->id 
            ],
        ], [
            'name.regex' => 'Le nom doit contenir uniquement des lettres.',
            'name.min' => 'Le nom doit contenir au moins 3 lettres.',
        ]);

        $category->update($validated);
        return redirect()->route('CategorieCentre.index')->with('success', 'Catégorie mise à jour avec succès.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('CategorieCentre.index')->with('success', 'Catégorie supprimée avec succès.');
    }
}
