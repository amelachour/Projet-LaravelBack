@extends('layouts/contentNavbarLayout')

@section('title', 'Ajouter un Équipement')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Ajouter un Équipement</span></h4>

<form action="{{ route('equipment.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*">
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Nom</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="type" class="form-label">Type</label>
        <input type="text" class="form-control" id="type" name="type" value="{{ old('type') }}" required>
        @error('type')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="purchase_date" class="form-label">Date d'Achat</label>
        <input type="date" class="form-control" id="purchase_date" name="purchase_date" value="{{ old('purchase_date') }}" required>
        @error('purchase_date')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    
    <button type="submit" class="btn btn-success">Ajouter</button>
</form>
@endsection
