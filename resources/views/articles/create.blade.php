@extends('layouts/contentNavbarLayout')

@section('title', 'Ajouter un Article')

@section('content')
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Ajouter un Article</span></h4>

  <div class="card">
    <div class="card-header">
      <h5 class="mb-0">Nouveau Article</h5>
    </div>
    <div class="card-body">
      <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Title Input -->
        <div class="mb-3">
          <label for="title" class="form-label">Titre</label>
          <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}" required>
          @error('title')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <!-- Body Input -->
        <div class="mb-3">
          <label for="body" class="form-label">Contenu</label>
          <textarea name="body" class="form-control" id="body" rows="5" required>{{ old('body') }}</textarea>
          @error('body')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <!-- Location Input -->
        <div class="mb-3">
          <label for="location" class="form-label">Localisation</label>
          <input type="text" name="location" class="form-control" id="location" value="{{ old('location') }}">
          @error('location')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <!-- Media Input (Image or Video) -->
        <div class="mb-3">
          <label for="media" class="form-label">Image ou Vidéo (optionnel)</label>
          <input type="file" name="media" class="form-control" id="media" accept="image/*,video/*">
          @error('media')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Ajouter l'Article</button>
        <a href="{{ route('articles.index') }}" class="btn btn-secondary">Retour</a>
      </form>
    </div>
  </div>
@endsection
