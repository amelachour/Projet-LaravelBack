@extends('layouts/contentNavbarLayout')

@section('title', 'Modifier un Déchet')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Modifier un Déchet</span></h4>

<form action="{{ route('wastes.update', $waste->id) }}" method="POST">
    @csrf
    @method('PUT')

   

    <div class="mb-3">
        <label for="type" class="form-label">Type</label>
        <select class="form-select" id="type" name="type" >
            <option value="" disabled>Sélectionnez un type</option>
            <option value="plastique" {{ old('type', $waste->type) == 'plastique' ? 'selected' : '' }}>Plastique</option>
            <option value="papier" {{ old('type', $waste->type) == 'papier' ? 'selected' : '' }}>Papier</option>
            <option value="métal" {{ old('type', $waste->type) == 'métal' ? 'selected' : '' }}>Métal</option>
            <option value="déchets organiques" {{ old('type', $waste->type) == 'déchets organiques' ? 'selected' : '' }}>Déchets Organiques</option>
            <option value="verre" {{ old('type', $waste->type) == 'verre' ? 'selected' : '' }}>Verre</option>
        </select>
        @error('type')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="weight" class="form-label">Poids (kg)</label>
        <input type="text" class="form-control" id="weight" name="weight" value="{{ old('weight', $waste->weight) }}" required min="0" step="0.01">
        @error('weight')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Modifier</button>
</form>
@endsection
