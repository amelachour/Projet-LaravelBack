@extends('layouts/contentNavbarLayout')

@section('title', 'Enregistrements d’Élimination')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Liste des demandes d’Élimination</span></h4>


<div class="mb-4">
    <input type="text" id="searchInput" class="form-control" placeholder="Rechercher par déchet..." onkeyup="filterTable()">
</div>


<div class="mb-4 form-check">
    <input type="checkbox" id="nonTreatedFilter" class="form-check-input" onchange="filterTable()">
    <label class="form-check-label" for="nonTreatedFilter">Afficher uniquement les demandes non traitées</label>
</div>

<div class="card">
    <h5 class="card-header">Les demandes d’Élimination</h5>
    <div class="table-responsive text-nowrap">
        <table class="table" id="disposalRecordsTable">
            <thead class="table-light">
                <tr>
                    <th>Déchet</th>
                    <th>Méthode</th>
                    <th>Date d’Élimination</th>
                    <th>Lieu</th>
<<<<<<< HEAD
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @foreach($disposalRecords as $record)
                <tr>
                    <td>{{ $record->waste->type }}</td>
                    <td>{{ $record->method }}</td>
                    <td>{{ $record->disposal_date }}</td>
                    <td>{{ $record->location }}</td>
                    <td class="{{ $record->status == 'traitée' ? 'text-success' : 'text-danger' }}">
                        {{ ucfirst($record->status) }}
                    </td>
                    <td>
                        <form action="{{ route('disposalRecords.destroy', $record->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-icon text-danger btn-rounded" title="Supprimer">
                                <i class="mdi mdi-trash-can-outline" style="font-size: 1rem;"></i>
                            </button>
                        </form>

                        <form action="{{ route('disposalRecords.process', $record->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-icon btn-rounded" title="{{ $record->status == 'traitée' ? 'Remettre en cours' : 'Éliminer' }}" style="font-size: 1.5rem;">
                                @if ($record->status == 'traitée')
                                    <i class="mdi mdi-check-circle text-success"></i>
                                @else
                                    <i class="mdi mdi-timer-sand text-danger"></i>
                                @endif
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer d-flex justify-content-between align-items-center">
        <span id="totalRecords"></span>
        <div>
            <button id="prevBtn" class="btn btn-secondary" onclick="changePage(-1)" title="Page précédente">
                <i class="mdi mdi-chevron-left"></i> 
            </button>
            <button id="nextBtn" class="btn btn-secondary" onclick="changePage(1)" title="Page suivante">
                <i class="mdi mdi-chevron-right"></i> 
            </button>
        </div>
    </div>
</div>

<script>
    let currentPage = 1;
    const recordsPerPage = 5; 
    let filteredRecords = [];

    function filterTable() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const table = document.getElementById('disposalRecordsTable');
        const tr = table.getElementsByTagName('tr');
        const showOnlyNonTreated = document.getElementById('nonTreatedFilter').checked;

        filteredRecords = [];

        for (let i = 1; i < tr.length; i++) {
            const tdWaste = tr[i].getElementsByTagName('td')[0]; 
            const tdStatus = tr[i].getElementsByTagName('td')[4]; 
            let displayRow = true;

            if (tdWaste) {
                const txtValue = tdWaste.textContent || tdWaste.innerText;
                displayRow = txtValue.toLowerCase().indexOf(filter) > -1;
            }

            if (showOnlyNonTreated && tdStatus) {
                displayRow = displayRow && tdStatus.textContent.trim() !== 'Traitée';
            }

            if (displayRow) {
                filteredRecords.push(tr[i]);
            }
        }

       
        currentPage = 1;
        displayRecords();
    }

    function displayRecords() {
        const tableBody = document.getElementById('tableBody');
        tableBody.innerHTML = ''; 
        const totalRecords = filteredRecords.length;
        document.getElementById('totalRecords').innerText = `Total: ${totalRecords} enregistrements`;

        const startIndex = (currentPage - 1) * recordsPerPage;
        const endIndex = Math.min(startIndex + recordsPerPage, totalRecords);

        for (let i = startIndex; i < endIndex; i++) {
            tableBody.appendChild(filteredRecords[i]);
        }

       
        document.getElementById('prevBtn').disabled = currentPage === 1;
        document.getElementById('nextBtn').disabled = endIndex >= totalRecords;
    }

    function changePage(direction) {
        currentPage += direction;
        displayRecords();
    }

   
    filterTable();
</script>

@endsection
=======
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
    @foreach($disposalRecords as $record)
        <tr>
            <td>{{ $record->waste->type }}</td>
            <td>{{ $record->method }}</td>
            <td>{{ $record->disposal_date }}</td>
            <td>{{ $record->location }}</td>
            <td>
             
                <a href="{{ route('disposalRecords.edit', $record->id) }}" class="btn btn-icon btn-primary btn-rounded" title="Modifier">
                    <i class="mdi mdi-pencil"></i>
                </a>
                
               
                <form action="{{ route('disposalRecords.destroy', $record->id) }}" method="POST" style="display:inline;">
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
>>>>>>> origin/main
