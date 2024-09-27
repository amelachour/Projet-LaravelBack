@extends('layouts/contentNavbarLayout')

@section('title', 'Détails de l\'Équipement')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Détails de l'Équipement</span></h4>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">{{ $equipment->name }}</h5>
    </div>
    <div class="card-body">
         
        @if ($equipment->image_path)
            <p><strong></strong></p>
            <img src="{{ asset('storage/' . $equipment->image_path) }}" alt="{{ $equipment->name }}" style="max-width: 200px; max-height: 200px;">
        @endif

        <p><strong>ID :</strong> {{ $equipment->id }}</p>
        <p><strong>Type :</strong> {{ $equipment->type }}</p>
        <p><strong>Date d'Achat :</strong> {{ $equipment->purchase_date }}</p>
        <p><strong>Date de Création :</strong> {{ $equipment->created_at }}</p>
        <p><strong>Date de Mise à Jour :</strong> {{ $equipment->updated_at }}</p>
       
        <a href="{{ route('equipment.edit', $equipment->id) }}" class="btn btn-warning">Modifier</a>
        <form action="{{ route('equipment.destroy', $equipment->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet équipement ?');">Supprimer</button>
        </form>
        <a href="{{ route('equipment.index') }}" class="btn btn-secondary">Retour à la liste</a>
    </div>
</div>
@endsection
