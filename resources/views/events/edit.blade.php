@extends('layouts/contentNavbarLayout')

@section('title', 'Modifier un Événement')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Événements /</span> Modifier un événement</h4>

<div class="card">
  <h5 class="card-header">Modifier un événement de collecte de déchets</h5>
  <div class="card-body">
    <!-- Formulaire pour modifier un événement -->
    <form action="{{ route('events.update', $event->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label for="name" class="form-label">Nom de l'événement</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $event->name) }}" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', $event->date  ? $event->date->format('Y-m-d') : '')}}" required>
        @error('date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="location" class="form-label">Lieu</label>
        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location', $event->location) }}" required>
        @error('location')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <button type="submit" class="btn btn-primary">Modifier l'événement</button>
      <a href="{{ route('events.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
  </div>
</div>
@endsection
