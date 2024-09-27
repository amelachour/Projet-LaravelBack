@extends('layouts/contentNavbarLayout')

@section('title', 'Modifier un Enregistrement d’Élimination')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Modifier un Enregistrement d’Élimination</span></h4>

<form action="{{ route('disposalRecords.update', $disposalRecord->id) }}" method="POST">
    @csrf
    @method('PUT')

  

    <div class="mb-3">
        <label for="waste_id" class="form-label">Déchet</label>
        <select class="form-select" id="waste_id" name="waste_id" required>
            @foreach($wastes as $waste)
                <option value="{{ $waste->id }}" {{ $waste->id == $disposalRecord->waste_id ? 'selected' : '' }}>
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
        <input type="text" class="form-control" id="method" name="method" value="{{ old('method', $disposalRecord->method) }}" required>
        @error('method')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="disposal_date" class="form-label">Date d’Élimination</label>
        <input type="date" class="form-control" id="disposal_date" name="disposal_date" value="{{ old('disposal_date', $disposalRecord->disposal_date) }}" required>
        @error('disposal_date')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="location" class="form-label">Lieu</label>
        <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $disposalRecord->location) }}" required>
        @error('location')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Modifier</button>
</form>
@endsection
