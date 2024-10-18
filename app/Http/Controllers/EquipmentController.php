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
        // Validation des champs
        $request->validate([
            'name' => [
                'required',
                'regex:/^[\pL\s]+$/u', // Autorise les lettres et les espaces
                'min:3',
            ],
            'type' => [
                'required',
            ],
            'purchase_date' => [
                'required',
                'date',
                'before_or_equal:today',
            ],
            'image' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048',
            ],
        ], [
            'name.required' => 'Le nom de l\'équipement est requis.',
            'name.regex' => 'Le nom ne peut contenir que des lettres et des espaces.',
            'name.min' => 'Le nom doit contenir au moins 3 lettres.',
            'type.required' => 'Le type de l\'équipement est requis.',
            'purchase_date.required' => 'La date d\'achat est requise.',
            'purchase_date.date' => 'La date d\'achat doit être une date valide.',
            'purchase_date.before_or_equal' => 'La date d\'achat doit être égale ou antérieure à aujourd\'hui.',
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'L\'image doit être de type jpeg, png, jpg ou gif.',
            'image.max' => 'L\'image ne peut pas dépasser 2048 Ko.',
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
            'name' => [
                'required',
                'regex:/^[\pL\s]+$/u',
                'min:3',
            ],
            'type' => [
                'required',
            ],
            'purchase_date' => [
                'required',
                'date',
                'before_or_equal:today',
            ],
            'image' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048',
            ],
        ], [
            'name.required' => 'Le nom de l\'équipement est requis.',
            'name.regex' => 'Le nom ne peut contenir que des lettres et des espaces.',
            'name.min' => 'Le nom doit contenir au moins 3 lettres.',
            'type.required' => 'Le type de l\'équipement est requis.',
            'purchase_date.required' => 'La date d\'achat est requise.',
            'purchase_date.date' => 'La date d\'achat doit être une date valide.',
            'purchase_date.before_or_equal' => 'La date d\'achat doit être égale ou antérieure à aujourd\'hui.',
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'L\'image doit être de type jpeg, png, jpg ou gif.',
            'image.max' => 'L\'image ne peut pas dépasser 2048 Ko.',
        ]);

        $data = $request->all();

        // Gestion de l'image
        if ($request->hasFile('image')) {
            if ($equipment->image_path) {
                Storage::disk('public')->delete($equipment->image_path);
            }

            $path = $request->file('image')->store('images', 'public');
            $data['image_path'] = $path;
        }

        $equipment->update($data);
        return redirect()->route('equipment.index')->with('success', 'Équipement modifié avec succès.');
    }

    public function destroy(Equipment $equipment)
    {
        if ($equipment->image_path) {
            Storage::disk('public')->delete($equipment->image_path);
        }

        $equipment->delete();
        return redirect()->route('equipment.index')->with('success', 'Équipement supprimé avec succès.');
    }

    public function show(Equipment $equipment)
    {
        return view('equipment.show', compact('equipment'));
    }

}
