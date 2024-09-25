<?php

namespace App\Http\Controllers;

use App\Models\Waste;
use Illuminate\Http\Request;

class WasteController extends Controller
{
  public function index()
  {
    $wastes = Waste::all();
    return view('wastes.index', compact('wastes'));
  }

  public function create()
  {
    return view('wastes.create');
  }

  public function store(Request $request)
  {
    $request->validate(
      [
        'type' => 'required',
        'weight' => 'required|numeric',
      ],
      [
        'type.required' => 'Le type est obligatoire.',
        'weight.required' => 'Le poids est obligatoire.',
        'weight.numeric' => 'Le poids doit être un nombre.',
      ]
    );

    Waste::create($request->all());

    return redirect()
      ->route('wastes.index')
      ->with('success', 'Déchet ajouté avec succès.');
  }

  public function show(string $id)
  {
    //
  }

  public function edit($id)
  {
    $waste = Waste::findOrFail($id);
    return view('wastes.edit', compact('waste'));
  }

  public function update(Request $request, $id)
  {
    $validatedData = $request->validate(
      [
        'type' => 'required|string|max:255',
        'weight' => 'required|numeric|min:0',
      ],
      [
        'type.required' => 'Le type est obligatoire.',
        'weight.required' => 'Le poids est obligatoire.',
        'weight.numeric' => 'Le poids doit être un nombre.',
        'weight.min' => 'Le poids doit être supérieur ou égal à zéro.',
      ]
    );

    $waste = Waste::findOrFail($id);
    $waste->update($validatedData);

    return redirect()
      ->route('wastes.index')
      ->with('success', 'Déchet modifié avec succès.');
  }

  public function destroy($id)
  {
    $waste = Waste::findOrFail($id);
    $waste->delete();

    return redirect()
      ->route('wastes.index')
      ->with('success', 'Déchet supprimé avec succès.');
  }
}
