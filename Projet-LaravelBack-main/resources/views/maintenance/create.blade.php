@extends('layouts.contentNavbarLayout')

@section('title', 'Ajouter une Maintenance')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Ajouter une Maintenance</span></h4>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('maintenance.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="equipment_id" class="form-label">Sélectionner un Équipement</label>
        <select name="equipment_id" id="equipment_id" class="form-select" required>
            <option value="">-- Choisissez un Équipement --</option>
            @foreach($equipments as $equipment)
                <option value="{{ $equipment->id }}">{{ $equipment->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="maintenance_date" class="form-label">Date de Maintenance</label>
        <input type="date" class="form-control" id="maintenance_date" name="maintenance_date" required>
    </div>
    <div class="mb-3">
        <label for="details" class="form-label">Détails</label>
        <textarea class="form-control" id="details" name="details" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Ajouter la Maintenance</button>
</form>
@endsection
