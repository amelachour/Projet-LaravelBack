@extends('layouts/contentNavbarLayout')

@section('title', 'Enregistrements d’Élimination')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Liste des Enregistrements d’Élimination</span></h4>

<a href="{{ route('disposalRecords.create') }}" class="btn btn-primary mb-3">  <i class="mdi mdi-plus me-1"></i>Ajouter </a>


<div class="card">
    <h5 class="card-header">Enregistrements d’Élimination</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead class="table-light">
                <tr>
                    <th>Déchet</th>
                    <th>Méthode</th>
                    <th>Date d’Élimination</th>
                    <th>Lieu</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
    @foreach($disposalRecords as $record)
        <tr>
            <td>{{ $record->waste->type }}</td>
            <td>{{ $record->method }}</td>
            <td>{{ $record->disposal_date }}</td>
            <td>{{ $record->location }}</td>
            <td>
             
                <a href="{{ route('disposalRecords.edit', $record->id) }}" class="btn btn-icon btn-primary btn-rounded" title="Modifier">
                    <i class="mdi mdi-pencil"></i>
                </a>
                
               
                <form action="{{ route('disposalRecords.destroy', $record->id) }}" method="POST" style="display:inline;">
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