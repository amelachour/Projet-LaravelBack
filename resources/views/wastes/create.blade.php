@extends('layouts/contentNavbarLayout')

@section('title', 'Ajouter un Déchet')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Ajouter un Déchet</span></h4>
<form action="{{ route('wastes.store') }}" method="POST">
    @csrf

   

    <div class="mb-3">
        <label for="type" class="form-label">Type</label>
        <select class="form-select" id="type" name="type" >
            <option value="" disabled selected>Sélectionnez un type</option>
            <option value="plastique" {{ old('type') == 'plastique' ? 'selected' : '' }}>Plastique</option>
            <option value="papier" {{ old('type') == 'papier' ? 'selected' : '' }}>Papier</option>
            <option value="métal" {{ old('type') == 'métal' ? 'selected' : '' }}>Métal</option>
            <option value="déchets organiques" {{ old('type') == 'déchets organiques' ? 'selected' : '' }}>Déchets Organiques</option>
            <option value="verre" {{ old('type') == 'verre' ? 'selected' : '' }}>Verre</option>
           
        </select>
        @error('type')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="weight" class="form-label">Poids (kg)</label>
        <input type="text" class="form-control" id="weight" name="weight" value="{{ old('weight') }}" min="0" step="0.01" required>
        @error('weight')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-success">Ajouter</button>
</form>
@endsection
