@extends('layouts/contentNavbarLayout')

@section('title', 'Centres de Recyclage')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Liste des Centres de Recyclage</span></h4>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('CentreRecyclage.create') }}" class="btn btn-primary mb-3">Ajouter un Centre de Recyclage</a>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Centres de Recyclage</h5>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Location</th>
                    <th>Contact</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($centers as $center)
                    <tr>
                        <td>{{ $center->id }}</td>
                        <td>{{ $center->name }}</td>
                        <td>{{ $center->location }}</td>
                        <td>{{ $center->contact_info }}</td>
                        <td>
                            <a href="{{ route('CentreRecyclage.show', $center->id) }}" class="btn btn-info btn-sm"><i class="mdi mdi-eye"></i></a>
                            <a href="{{ route('CentreRecyclage.edit', $center->id) }}" class="btn btn-warning btn-sm"><i class="mdi mdi-pencil"></i></a>
                            <form action="{{ route('CentreRecyclage.destroy', $center->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce centre ?');"><i class="mdi mdi-trash-can-outline"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection