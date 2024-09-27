@extends('layouts/contentNavbarLayout')

@section('title', 'Détails de la Catégorie')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Détails de la Catégorie</span></h4>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">{{ $category->name }}</h5>
    </div>
    <div class="card-body">
        <p><strong>ID :</strong> {{ $category->id }}</p>
        <p><strong>Date de création :</strong> {{ $category->created_at }}</p>
        <p><strong>Date de mise à jour :</strong> {{ $category->updated_at }}</p>
        <a href="{{ route('CategorieCentre.edit', $category->id) }}" class="btn btn-warning">Modifier</a>
        <form action="{{ route('CategorieCentre.destroy', $category->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?');">Supprimer</button>
        </form>
        <a href="{{ route('CategorieCentre.index') }}" class="btn btn-secondary">Retour à la liste</a>
    </div>
</div>
@endsection
