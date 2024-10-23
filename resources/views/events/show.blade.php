

@extends('layouts/contentNavbarLayout')

@section('title', 'Détails de l\'Événement')

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Événement / </span> {{ $event->name }}
    </h4>

    <!-- Carte des détails de l'événement -->
    <div class="card mb-4">
        <h5 class="card-header">Détails de l'Événement</h5>
        <div class="card-body">
            <p><strong>Date :</strong> {{ $event->date ? $event->date->format('d-m-Y') : 'Date non définie' }}</p>

            <p><strong>Lieu :</strong> {{ $event->location }}</p>
        </div>
</div>

    <!-- Carte des participants -->
    <div class="card">
        <h5 class="card-header">Liste des Participants</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($event->participations as $participation)
                        <tr>
                            <td>{{ $participation->user->name }}</td>
                            <td>{{ $participation->user->email }}</td>
                            <td>
                                <form action="{{ route('participations.destroy', ['event' => $event->id, 'participation' => $participation->id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-icon btn-danger btn-rounded" title="Retirer">
                                        <i class="mdi mdi-trash-can-outline"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Aucun participant enregistré pour cet événement.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <br><br>
    <div class="mb-3 text-end">
        <a href="{{ route('events.index') }}" class="btn btn-primary">
            Retour
        </a>
    </div>
@endsection
