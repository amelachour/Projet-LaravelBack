@extends('layouts/contentNavbarLayout')

@section('title', 'Modifier un Centre de Recyclage')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Modifier un Centre de Recyclage</span></h4>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Modifier le Centre de Recyclage</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('CentreRecyclage.update', $recyclingCenter->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $recyclingCenter->name }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Localisation</label>
                <input type="text" name="location" class="form-control" id="location" value="{{ $recyclingCenter->location }}" required>
                @error('location')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="contact_info" class="form-label">Informations de Contact</label>
                <input type="text" name="contact_info" class="form-control" id="contact_info" value="{{ $recyclingCenter->contact_info }}" required>
                @error('contact_info')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="categories" class="form-label">Catégories</label>
                <select name="categories[]" class="form-control" id="categories" multiple required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $recyclingCenter->categories->contains($category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('categories')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Mettre à Jour</button>
            <a href="{{ route('CentreRecyclage.index') }}" class="btn btn-secondary">Retour</a>
        </form>
    </div>
</div>
@endsection
