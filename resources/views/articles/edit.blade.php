@extends('layouts/contentNavbarLayout')

@section('title', 'Modifier un Article')

@section('content')
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Modifier un Article</span></h4>

  <div class="card">
    <div class="card-header">
      <h5 class="mb-0">Modifier l'Article</h5>
    </div>
    <div class="card-body">
      <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Title Input -->
        <div class="mb-3">
          <label for="title" class="form-label">Titre</label>
          <input type="text" name="title" class="form-control" id="title" value="{{ $article->title }}" required>
          @error('title')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <!-- Body Input -->
        <div class="mb-3">
          <label for="body" class="form-label">Contenu</label>
          <textarea name="body" class="form-control" id="body" rows="5" required>{{ $article->body }}</textarea>
          @error('body')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <!-- Location Input -->
        <div class="mb-3">
          <label for="location" class="form-label">Localisation</label>
          <input type="text" name="location" class="form-control" id="location" value="{{ $article->location }}">
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

        <!-- Display current media (if any) -->
        @if ($article->media)
          <div class="mb-3">
            <label for="current_media" class="form-label">Média Actuel</label>
            <div>
              @if ($article->media->is_image)
                <img src="{{ asset($article->media->path) }}" alt="Article Media" width="300">
              @else
                <video width="320" height="240" controls>
                  <source src="{{ asset($article->media->path) }}" type="{{ \Illuminate\Support\Facades\File::mimeType(storage_path('app/' . $article->media->path)) }}">
                  Your browser does not support the video tag.
                </video>
              @endif
            </div>
          </div>
        @endif

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Mettre à Jour</button>
        <a href="{{ route('articles.index') }}" class="btn btn-secondary">Retour</a>
      </form>
    </div>
  </div>
@endsection
