<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Equipment;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    // Afficher toutes les maintenances
    public function index()
    {
        $maintenances = Maintenance::with('equipment')->get(); // Charger les maintenances avec les équipements
        return view('maintenance.index', compact('maintenances'));
    }

    // Afficher le formulaire de création d'une nouvelle maintenance
    public function create()
    {
        $equipments = Equipment::all(); // Charger tous les équipements
        return view('maintenance.create', compact('equipments'));
    }

    // Enregistrer une nouvelle maintenance
    public function store(Request $request)
    {
        $validated = $request->validate([
            'equipment_id' => 'required|exists:equipment,id', // Vérifiez que l'équipement existe
            'maintenance_date' => 'required|date|after:today', // Date de maintenance doit être dans le futur
            'details' => 'required|string', // Détails doivent être du texte
        ], [
            'equipment_id.required' => 'L\'équipement est requis.',
            'equipment_id.exists' => 'L\'équipement sélectionné n\'existe pas.',
            'maintenance_date.required' => 'La date de maintenance est obligatoire.',
            'maintenance_date.date' => 'La date de maintenance doit être une date valide.',
            'maintenance_date.after' => 'La date de maintenance doit être postérieure à aujourd\'hui.',
            'details.required' => 'Les détails de la maintenance sont obligatoires.',
            'details.string' => 'Les détails doivent être une chaîne de caractères valide.',
        ]);

        Maintenance::create($validated); // Créer une nouvelle maintenance
        return redirect()->route('maintenance.index')->with('success', 'Maintenance ajoutée avec succès!');
    }

    // Afficher le formulaire d'édition d'une maintenance
    public function edit(Maintenance $maintenance)
    {
        $equipments = Equipment::all(); // Charger tous les équipements
        return view('maintenance.edit', compact('maintenance', 'equipments'));
    }

    // Mettre à jour une maintenance existante
    public function update(Request $request, Maintenance $maintenance)
    {
        $validated = $request->validate([
            'equipment_id' => 'required|exists:equipment,id', // Vérifiez que l'équipement existe
            'maintenance_date' => 'required|date|after:today', // Date de maintenance doit être dans le futur
            'details' => 'required|string', // Détails doivent être du texte
        ], [
            'equipment_id.required' => 'L\'équipement est requis.',
            'equipment_id.exists' => 'L\'équipement sélectionné n\'existe pas.',
            'maintenance_date.required' => 'La date de maintenance est obligatoire.',
            'maintenance_date.date' => 'La date de maintenance doit être une date valide.',
            'maintenance_date.after' => 'La date de maintenance doit être postérieure à aujourd\'hui.',
            'details.required' => 'Les détails de la maintenance sont obligatoires.',
            'details.string' => 'Les détails doivent être une chaîne de caractères valide.',
        ]);

        $maintenance->update($validated); // Mettre à jour la maintenance
        return redirect()->route('maintenance.index')->with('success', 'Maintenance mise à jour avec succès!');
    }

    // Afficher les détails d'une maintenance
    public function show(Maintenance $maintenance)
    {
        return view('maintenance.show', compact('maintenance')); // Afficher les détails de la maintenance
    }

    // Supprimer une maintenance
    public function destroy(Maintenance $maintenance)
    {
        // Si vous avez des fichiers associés à la maintenance, vous pouvez les supprimer ici
        // Par exemple, s'il y a un chemin d'image associé
        // if ($maintenance->image_path) {
        //     Storage::disk('public')->delete($maintenance->image_path);
        // }
    
        $maintenance->delete(); // Supprimer la maintenance
        return redirect()->route('maintenance.index')->with('success', 'Maintenance supprimée avec succès!');
    }
    
}
