<?php

namespace App\Http\Controllers;
use App\Models\Event; 

use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Lire tous les événements
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Formulaire de création
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Créer un nouvel événement
        $request->validate([
        'name' => 'required|min:3|max:255',
        'date' => 'required|date',
        'location' => 'required|min:3|max:255',
    ], [
        'name.required' => 'Le nom de l\'événement est obligatoire.',
        'name.min' => 'Le nom de l\'événement doit contenir au moins 3 caractères.',
        'name.max' => 'Le nom de l\'événement ne doit pas dépasser 255 caractères.',
        'date.required' => 'La date est obligatoire.',
        'date.date' => 'La date doit être une date valide.',
        'location.required' => 'Le lieu est obligatoire.',
        'location.min' => 'Le lieu doit contenir au moins 3 caractères.',
        'location.string' => 'Le lieu doit être une chaîne de caractères.',
        'location.max' => 'Le lieu ne doit pas dépasser 255 caractères.',
    ]);


        Event::create($request->all());
        return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id , Event $event)
    {   
        //$event->load('participations.user');
       // Récupérer l'événement avec ses participations et les utilisateurs associés
         $event = Event::with('participations.user')->findOrFail($id);
        // Afficher un seul événement
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( Event $event)
    {
        //Formulaire d'édition
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Mettre à jour un événement
        $request->validate([
            'name' => 'required|string|max:255|min:3',
            'date' => 'required|date',
            'location' => 'required|string|max:255|min:3',
        ], [
            'name.required' => 'Le nom de l\'événement est obligatoire.',
            'name.string' => 'Le nom de l\'événement doit être une chaîne de caractères.',
            'name.min' => 'Le nom de l\'événement doit contenir au moins 3 caractères.',
            'name.max' => 'Le nom de l\'événement ne doit pas dépasser 255 caractères.',
            'date.required' => 'La date est obligatoire.',
            'date.date' => 'La date doit être une date valide.',
            'location.required' => 'Le lieu est obligatoire.',
            'location.string' => 'Le lieu doit être une chaîne de caractères.',
            'name.min' => 'Le nom de l\'événement doit contenir au moins 3 caractères.',
            'location.max' => 'Le lieu ne doit pas dépasser 255 caractères.',
        ]);

            // Récupérer l'événement par son ID
        $event = Event::findOrFail($id);

        $event->update($request->all());
        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)

    {
        // Récupérer l'événement par son ID
        $event = Event::findOrFail($id);
        //Supprimer un événement
        $event->delete();
        return redirect()->route('events.index');
    }
}
