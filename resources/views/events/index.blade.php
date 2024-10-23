@extends('layouts/contentNavbarLayout')

@section('title', 'Liste des Événements')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Liste des Événements</span></h4>

<a href="{{ route('events.create') }}" class="btn btn-success">
    <i class="mdi mdi-plus me-1"></i> Ajouter 
</a>


<div class="card mt-4">
    <h5 class="card-header">Liste des Événements</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead class="table-light">
                <tr>
                    <th>Nom de l'Événement</th>
                    <th>Date</th>
                    <th>Lieu</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                    <tr>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->date->format('d-m-Y') }}</td>
                        <td>{{ $event->location }}</td>
                        <td>
                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-icon btn-info btn-rounded me-1" title="Détails">
                                <i class="mdi mdi-eye"></i>
                            </a>
                            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-icon btn-success btn-rounded" title="Modifier">
                                <i class="mdi mdi-pencil"></i>
                            </a>
                            
                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">
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
