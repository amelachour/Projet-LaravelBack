@extends('layouts/contentNavbarLayout')

@section('title', 'Ajouter un Enregistrement d’Élimination')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Ajouter un Enregistrement d’Élimination</span></h4>



<form action="{{ route('disposalRecords.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="waste_id" class="form-label">Déchet</label>
        <select class="form-select" id="waste_id" name="waste_id" required>
            <option value="" disabled selected>Sélectionnez un déchet</option>
            @foreach($wastes as $waste)
                <option value="{{ $waste->id }}" {{ old('waste_id') == $waste->id ? 'selected' : '' }}>
                    {{ $waste->type }}
                </option>
            @endforeach
        </select>
        @error('waste_id')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="method" class="form-label">Méthode d’Élimination</label>
        <input type="text" class="form-control" id="method" name="method" value="{{ old('method') }}" required>
        @error('method')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="disposal_date" class="form-label">Date d’Élimination</label>
        <input type="date" class="form-control" id="disposal_date" name="disposal_date" value="{{ old('disposal_date') }}" required>
        @error('disposal_date')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="location" class="form-label">Lieu</label>
        <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}" required>
        @error('location')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>
@endsection
