@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Liste des Déchets /</span> Déchets
</h4>
   


<a href="{{ route('wastes.create') }}" class="btn btn-success ">
    <i class="mdi mdi-plus me-1"></i> Ajouter 
</a>




    <div class="card mt-4">
  <h5 class="card-header">Liste des Déchets </h5>
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead class="table-light">
   
        <tr>
            <th>Type</th>
            <th>Poids</th>
            <th>Date de création</th>
            <th>Actions</th>
        </tr>
        </thead>

        <tbody>
        @foreach($wastes as $waste)
            <tr>
                <td>{{ $waste->type }}</td>
                <td>{{ $waste->weight }} kg</td>
                <td>{{ $waste->created_at }}</td>
               
          <td>
               
                <a href="{{ route('wastes.edit', $waste->id) }}" class="btn btn-icon btn-success btn-rounded" title="Modifier">
                    <i class="mdi mdi-pencil"></i>
                </a>
                
                
                <form action="{{ route('wastes.destroy', $waste->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-icon btn-danger btn-rounded" title="Supprimer">
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
@endsection

       
        
       



          