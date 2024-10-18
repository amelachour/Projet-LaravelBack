@extends('layouts/contentNavbarLayout')

<!-- Toastr CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

@section('title', 'Liste des Déchets')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Liste des Déchets /</span> Déchets</h4>

<div class="mb-4">
    <input type="text" id="searchInput" class="form-control w-25" placeholder="Rechercher par type de déchet..." onkeyup="filterTable()">
</div>

<div class="card mt-4">
    <h5 class="card-header">Liste des Déchets</h5>
    <div class="table-responsive text-nowrap">
        <table class="table" id="wasteTable">
            <thead class="table-light">
                <tr>
                    <th>Type</th>
                    <th>Poids</th>
                    <th>Date de création</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="wasteBody">
            @foreach($wastes as $waste)
                <tr data-id="{{ $waste->id }}">
                    <td>{{ $waste->type }}</td>
                    <td>{{ $waste->weight }} kg</td>
                    <td>{{ $waste->created_at }}</td>
                    <td class="{{ $waste->status == 'éliminé' ? 'text-success' : 'text-danger' }}">
                        {{ ucfirst($waste->status) }}
                    </td>
                    <td>
                        <form action="{{ route('wastes.destroy', $waste->id) }}" method="POST" class="deleteForm" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-icon text-danger btn-rounded delete-btn" title="Supprimer" data-id="{{ $waste->id }}">
                                <i class="mdi mdi-trash-can-outline"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer d-flex justify-content-between align-items-center">
        <div id="totalCount" class="text-muted">
            Total des déchets : {{ count($wastes) }}
        </div>
    </div>
</div>

<script>
    
    
    document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const wasteId = this.getAttribute('data-id');
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "Vous ne pourrez pas revenir en arrière !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, supprimer !',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = this.closest('form');
                    const formData = new FormData(form);
                    const url = form.action;

                    fetch(url, {
                        method: 'DELETE',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            return response.json();
                        }
                        throw new Error('Erreur lors de la suppression.');
                    })
                    .then(data => {
                        toastr.success("Déchet supprimé avec succès.");
                        document.querySelector(`tr[data-id="${wasteId}"]`).remove();  
                        updateTotalCount(); 
                    })
                    .catch(error => {
                        console.error("Erreur:", error);
                        toastr.error("Une erreur s'est produite.");
                    });
                }
            });
        });
    });
});



    function updateTotalCount() {
        const totalCount = document.querySelectorAll('#wasteBody tr').length;
        document.getElementById('totalCount').textContent = `Total des déchets : ${totalCount}`;
    }

    function filterTable() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const table = document.getElementById('wasteTable');
        const tr = table.getElementsByTagName('tr');

        let filteredRows = [];
        for (let i = 1; i < tr.length; i++) {
            const td = tr[i].getElementsByTagName('td')[0]; 
            if (td) {
                const txtValue = td.textContent || td.innerText;
                if (txtValue.toLowerCase().indexOf(filter) > -1) {
                    filteredRows.push(tr[i]);
                }
            }
        }

        const tableBody = document.getElementById('wasteBody');
        tableBody.innerHTML = '';

        filteredRows.forEach(row => {
            tableBody.appendChild(row);
        });

        updateTotalCount(); 
    }

</script>


@endsection
