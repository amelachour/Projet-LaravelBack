@extends('layouts/contentNavbarLayout')

@section('title', 'Ajouter une Catégorie')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Ajouter une Catégorie</span></h4>

<form action="{{ route('CategorieCentre.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Nom</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-success">Ajouter</button>
</form>
@endsection
