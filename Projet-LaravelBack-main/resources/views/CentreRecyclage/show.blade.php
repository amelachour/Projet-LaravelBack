@extends('layouts/contentNavbarLayout')

@section('title', 'Détails du Centre de Recyclage')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Détails du Centre de Recyclage</span></h4>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">{{ $recyclingCenter->name }}</h5>
    </div>
    <div class="card-body">
        <p><strong>ID :</strong> {{ $recyclingCenter->id }}</p>
        <p><strong>Localisation :</strong> {{ $recyclingCenter->location }}</p>
        <p><strong>Contact :</strong> {{ $recyclingCenter->contact_info }}</p>
        <p><strong>Catégories :</strong> 
            @foreach ($recyclingCenter->categories as $category)
                {{ $category->name }}@if (!$loop->last), @endif
            @endforeach
        </p>
        <a href="{{ route('CentreRecyclage.edit', $recyclingCenter->id) }}" class="btn btn-warning">Modifier</a>
        <form action="{{ route('CentreRecyclage.destroy', $recyclingCenter->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce centre ?');">Supprimer</button>
        </form>
        <a href="{{ route('CentreRecyclage.index') }}" class="btn btn-secondary">Retour à la liste</a>
    </div>
</div>
@endsection
