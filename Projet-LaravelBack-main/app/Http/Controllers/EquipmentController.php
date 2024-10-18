<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 

class EquipmentController extends Controller
{
    public function index()
    {
        $equipment = Equipment::all();
        return view('equipment.index', compact('equipment'));
    }

    public function create()
    {
        return view('equipment.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'purchase_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation de l'image
        ]);

        $data = $request->all();

        // Gestion de l'image
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public'); // Stocke l'image
            $data['image_path'] = $path; // Assigne le chemin de l'image à l'attribut
        }

        Equipment::create($data);
        return redirect()->route('equipment.index')->with('success', 'Équipement ajouté avec succès.');
    }

    public function edit(Equipment $equipment)
    {
        return view('equipment.edit', compact('equipment'));
    }

    public function update(Request $request, Equipment $equipment)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'purchase_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation de l'image
        ]);

        $data = $request->all();

        // Gestion de l'image
        if ($request->hasFile('image')) {
            // Suppression de l'ancienne image si elle existe
            if ($equipment->image_path) {
                Storage::disk('public')->delete($equipment->image_path); // Utilisez Storage ici
            }

            $path = $request->file('image')->store('images', 'public'); // Stocke la nouvelle image
            $data['image_path'] = $path; // Assigne le chemin de la nouvelle image à l'attribut
        }

        $equipment->update($data);
        return redirect()->route('equipment.index')->with('success', 'Équipement modifié avec succès.');
    }

    public function destroy(Equipment $equipment)
    {
        // Suppression de l'image associée si elle existe
        if ($equipment->image_path) {
            Storage::disk('public')->delete($equipment->image_path); // Utilisez Storage ici
        }

        $equipment->delete();
        return redirect()->route('equipment.index')->with('success', 'Équipement supprimé avec succès.');
    }

    public function show(Equipment $equipment)
    {
        return view('equipment.show', compact('equipment'));
    }
}
