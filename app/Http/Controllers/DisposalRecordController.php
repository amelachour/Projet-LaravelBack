<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DisposalRecord;
use App\Models\Waste;

class DisposalRecordController extends Controller
{
  public function index()
  {
    $disposalRecords = DisposalRecord::with('waste')->get();
    return view('disposalRecords.index', compact('disposalRecords'));
  }

  public function create()
  {
    $wastes = Waste::all();
    return view('disposalRecords.create', compact('wastes'));
  }

  public function store(Request $request)
  {
    $validated = $request->validate(
      [
        'waste_id' => 'required|exists:wastes,id',
        'method' => 'required|string|min:3|regex:/^[a-zA-Z\s]+$/',
        'disposal_date' => 'required|date|after_or_equal:today',
        'location' => 'required|string|regex:/^(?=.*[a-zA-Z])(?=.*[0-9]).*$/',
      ],
      [
        'method.regex' => 'La méthode d\'élimination doit contenir uniquement des lettres et au moins 3 lettres.',
        'method.min' => 'La méthode d\'élimination doit comporter au moins 3 lettres.',
        'location.regex' =>
          'Le lieu doit contenir au moins une lettre et ne peut pas être composé uniquement de chiffres.',
      ]
    );

    DisposalRecord::create($validated);

    return redirect()
      ->route('disposalRecords.index')
      ->with('success', 'Enregistrement d\'élimination ajouté avec succès.');
  }

  public function edit($id)
  {
    $disposalRecord = DisposalRecord::findOrFail($id);
    $wastes = Waste::all();
    return view('disposalRecords.edit', compact('disposalRecord', 'wastes'));
  }

  public function update(Request $request, $id)
  {
    $validated = $request->validate(
      [
        'waste_id' => 'required|exists:wastes,id',
        'method' => 'required|string|min:3|regex:/^[a-zA-Z\s]+$/',
        'disposal_date' => 'required|date|after_or_equal:today',
        'location' => 'required|string|regex:/^(?=.*[a-zA-Z])(?=.*[0-9]).*$/',
      ],
      [
        'method.regex' => 'La méthode d\'élimination doit contenir uniquement des lettres et au moins 3 lettres.',
        'method.min' => 'La méthode d\'élimination doit comporter au moins 3 lettres.',
        'location.regex' =>
          'Le lieu doit contenir au moins une lettre et ne peut pas être composé uniquement de chiffres.',
      ]
    );

    $disposalRecord = DisposalRecord::findOrFail($id);
    $disposalRecord->update($validated);

    return redirect()
      ->route('disposalRecords.index')
      ->with('success', 'Enregistrement d’élimination modifié avec succès.');
  }

  public function destroy($id)
  {
    $disposalRecord = DisposalRecord::findOrFail($id);
    $disposalRecord->delete();
    return redirect()
      ->route('disposalRecords.index')
      ->with('success', 'Enregistrement d’élimination supprimé avec succès.');
  }
}
