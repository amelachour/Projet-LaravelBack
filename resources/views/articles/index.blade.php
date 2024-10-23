@extends('layouts/contentNavbarLayout')

@section('title', 'Liste des Articles')

@section('content')
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Liste des Articles</span></h4>

  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <a href="{{ route('articles.create') }}" class="btn btn-primary mb-3">Ajouter un Article</a>

  <div class="card">
    <div class="card-header">
      <h5 class="mb-0">Articles</h5>
    </div>
    <div class="card-body">
      <table class="table">
        <thead>
        <tr>
          <th>ID</th>
          <th>Titre</th>
          <th>Location</th>
          <th>Commentaires</th>
          <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($articles as $article)
          <tr>
            <td>{{ $article->id }}</td>
            <td>{{ $article->title }}</td>
            <td>{{ $article->location }}</td>

            <!-- Comments column with a modal trigger -->
            <td>
              <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#commentsModal-{{ $article->id }}">
                <i class="mdi mdi-comment-outline"></i> Voir les commentaires
              </button>

              <!-- Comments Modal -->
              <div class="modal fade" id="commentsModal-{{ $article->id }}" tabindex="-1" aria-labelledby="commentsModalLabel-{{ $article->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="commentsModalLabel-{{ $article->id }}">Commentaires pour l'article: {{ $article->title }}</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      @if ($article->comments->isNotEmpty())
                        <ul class="list-group">
                          @foreach ($article->comments as $comment)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              <div>
                                <strong>{{ $comment->user->name ?? 'Unknown' }}</strong>:
                                {{ $comment->comment }}
                              </div>
                              <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?');">
                                  <i class="mdi mdi-trash-can-outline"></i> Supprimer
                                </button>
                              </form>
                            </li>
                          @endforeach
                        </ul>
                      @else
                        <p>Aucun commentaire disponible pour cet article.</p>
                      @endif
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    </div>
                  </div>
                </div>
              </div>
            </td>

            <!-- Actions -->
            <td>
              <!-- Eye icon to trigger the article details modal -->
              <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#articleModal-{{ $article->id }}">
                <i class="mdi mdi-eye"></i>
              </button>

              <!-- Article Details Modal -->
              <div class="modal fade" id="articleModal-{{ $article->id }}" tabindex="-1" aria-labelledby="articleModalLabel-{{ $article->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="articleModalLabel-{{ $article->id }}">Détails de l'article: {{ $article->title }}</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p><strong>Titre:</strong> {{ $article->title }}</p>
                      <p><strong>Location:</strong> {{ $article->location }}</p>
                      <p><strong>Body:</strong> {{ $article->body }}</p>
                      <p><strong>Auteur:</strong> {{ $article->user->name ?? 'Unknown' }}</p>
                      <p><strong>Date de création:</strong> {{ \Carbon\Carbon::parse($article->created_at)->format('d/m/Y H:i') }}</p>

                      <!-- Display image or video if it exists -->
                      <h5>Media:</h5>
                      @if ($article->media && $article->media->is_image)
                        <img src="{{ asset($article->media->path) }}" alt="Article Image" width="300">
                      @elseif ($article->media)
                        <video width="320" height="240" controls>
                          <source src="{{ asset($article->media->path) }}" type="{{ \Illuminate\Support\Facades\File::mimeType(storage_path('app/' . $article->media->path)) }}">
                          Your browser does not support the video tag.
                        </video>
                      @else
                        <p>Aucun media disponible.</p>
                      @endif
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Edit and Delete buttons -->
              <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning btn-sm"><i class="mdi mdi-pencil"></i></a>
              <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?');">
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

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

@endsection
