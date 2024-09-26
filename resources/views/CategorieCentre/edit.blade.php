@extends('layouts/contentNavbarLayout')

@section('title', 'Modifier une Catégorie')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Modifier une Catégorie</span></h4>

<form action="{{ route('CategorieCentre.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Nom</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" required>
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Modifier</button>
</form>
@endsection
