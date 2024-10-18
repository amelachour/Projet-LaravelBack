@extends('layouts.contentNavbarLayout')

@section('title', 'Liste des Maintenances')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Liste des Maintenances</span></h4>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<a href="{{ route('maintenance.create') }}" class="btn btn-success">
    <i class="mdi mdi-plus me-1"></i> Ajouter une Maintenance
</a>

<div class="card mt-4">
    <h5 class="card-header">Liste des Maintenances</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead class="table-light">
                <tr>
                    <th>Équipement</th>
                    <th>Date de Maintenance</th>
                    <th>Détails</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($maintenances as $maintenance)
                    <tr>
                        <td>{{ $maintenance->equipment->name }}</td> <!-- Affiche le nom de l'équipement -->
                        <td>{{ $maintenance->maintenance_date }}</td>
                        <td>{{ $maintenance->details }}</td>
                        
                        <td>
                            <!-- Lien pour éditer la maintenance -->
                            <a href="{{ route('maintenance.edit', $maintenance->id) }}" class="btn btn-success btn-rounded" title="Modifier">
                                <i class="mdi mdi-pencil"></i>
                            </a>

                            <form action="{{ route('maintenance.destroy', $maintenance->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette maintenance ?');">
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
