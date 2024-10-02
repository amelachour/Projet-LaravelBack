@extends('layouts/contentNavbarLayout')

@section('title', 'Ajouter un Événement')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Événements /</span> Ajouter un événement</h4>

<div class="card">
  <h5 class="card-header">Créer un nouvel événement de collecte de déchets</h5>
  <div class="card-body">
    <!-- Formulaire pour créer un événement -->
    <form action="{{route('events.store') }}" method="POST">
      @csrf

      <div class="mb-3">
        <label for="name" class="form-label">Nom de l'événement</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nom de l'événement" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" required>
        @error('date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="location" class="form-label">Lieu</label>
        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" placeholder="Lieu de l'événement" required>
        @error('location')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <button type="submit" class="btn btn-success">Créer l'événement</button>
      <a href="{{ route('events.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
  </div>
</div>
@endsection

