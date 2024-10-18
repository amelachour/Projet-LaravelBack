@extends('layouts.contentNavbarLayout')

@section('title', 'Détails de la Maintenance')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Détails de la Maintenance /</span> {{ $equipment->name }}</h4>

<div class="card mt-4">
    <div class="card-header">
        <h5>Maintenance du {{ $maintenance->maintenance_date }}</h5>
    </div>
    <div class="card-body">
        <h6>Détails :</h6>
        <p>{{ $maintenance->details }}</p>
    </div>
    <div class="card-footer">
        <a href="{{ route('maintenance.index', $equipment->id) }}" class="btn btn-secondary">Retour à la liste</a>
        <a href="{{ route('maintenance.edit', [$equipment->id, $maintenance->id]) }}" class="btn btn-success">Modifier</a>
        <form action="{{ route('maintenance.destroy', [$equipment->id, $maintenance->id]) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Supprimer</button>
        </form>
    </div>
</div>
@endsection
