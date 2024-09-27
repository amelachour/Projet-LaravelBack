@extends('layouts/contentNavbarLayout')

@section('title', 'Liste des Équipements')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Liste des Équipements /</span> Équipements</h4>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('equipment.create') }}" class="btn btn-success">
    <i class="mdi mdi-plus me-1"></i> Ajouter un Équipement
</a>

<div class="card mt-4">
  <h5 class="card-header">Liste des Équipements</h5>
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead class="table-light">
        <tr>
            <th>Nom</th>
            <th>Type</th>
            <th>Date d'Achat</th>
            <th>Image</th> <!-- Nouvelle colonne pour l'image -->
            <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($equipment as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->type }}</td>
                <td>{{ $item->purchase_date }}</td>
                
                <td>
                    @if($item->image_path)
                        <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" style="width: 50px; height: auto;"> 
                    @else
                        <span>Aucune image</span>
                    @endif
                </td> <!-- Affichage de l'image -->
                
                <td>
                    <a href="{{ route('equipment.show', $item->id) }}" class="btn btn-icon btn-info btn-rounded" title="Afficher">
                        <i class="mdi mdi-eye"></i>
                    </a>
                    <a href="{{ route('equipment.edit', $item->id) }}" class="btn btn-success btn-rounded" title="Modifier">
                        <i class="mdi mdi-pencil"></i>
                    </a>
                    <form action="{{ route('equipment.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-rounded" title="Supprimer">
                            <i class="mdi mdi-trash-can-outline"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
