@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Catégories des Centres de Recyclage')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Liste des Catégories /</span> Catégories</h4>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('CategorieCentre.create') }}" class="btn btn-success ">
    <i class="mdi mdi-plus me-1"></i> Ajouter
</a>

<div class="card mt-4">
  <h5 class="card-header">Liste des Catégories de centres de Recyclage</h5>
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead class="table-light">
        <tr>
            <th>Nom</th>
            <th>Date de création</th>
            <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->created_at }}</td>
                <td>
                    <a href="{{ route('CategorieCentre.show', $category->id) }}" class="btn btn-icon btn-info btn-rounded" title="Afficher">
                        <i class="mdi mdi-eye"></i>
                    </a>
                    <a href="{{ route('CategorieCentre.edit', $category->id) }}" class="btn btn-icon btn-success btn-rounded" title="Modifier">
                        <i class="mdi mdi-pencil"></i>
                    </a>
                    <form action="{{ route('CategorieCentre.destroy', $category->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-icon btn-danger btn-rounded" title="Supprimer">
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
