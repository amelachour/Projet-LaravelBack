@extends('layouts.contentNavbarLayout')

@section('title', 'Modifier une Maintenance')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Modifier une Maintenance /</span> {{ $equipment->name }}</h4>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('maintenance.update', [$equipment->id, $maintenance->id]) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="maintenance_date" class="form-label">Date de Maintenance</label>
        <input type="date" class="form-control" id="maintenance_date" name="maintenance_date" value="{{ $maintenance->maintenance_date }}" required>
    </div>
    <div class="mb-3">
        <label for="details" class="form-label">Détails</label>
        <textarea class="form-control" id="details" name="details" rows="3" required>{{ $maintenance->details }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Modifier Maintenance</button>
</form>
@endsection
