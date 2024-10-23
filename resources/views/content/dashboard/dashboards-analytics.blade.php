@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection

@section('vendor-script')
<script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
@endsection

@section('page-script')
<script>
document.addEventListener('DOMContentLoaded', function () {
  // Bar Chart for Recycling Centers by Category
  var barOptions = {
    series: [{
      name: 'Centres de Recyclage',
      data: @json($centerCounts)
    }],
    chart: {
      height: 250,
      toolbar: {
        show: true
      }
    },
    plotOptions: {
      bar: {
        borderRadius: 8,
        dataLabels: {
          position: 'top',
        }
      }
    },
    xaxis: {
      categories: @json($categoryNames),
    },
    yaxis: {
      title: {
        text: 'Nombre de Centres'
      }
    }
  };

  var barChart = new ApexCharts(document.querySelector("#categoryStatsChart"), barOptions);
  barChart.render();

  // Pie Chart for Monthly Equipment Evolution
  var pieOptions = {
    series: @json($monthlyEquipmentCounts),
    chart: {
      type: 'pie',
      height: 250,
    },
    labels: @json($months),
    colors: ['#007bff', '#28a745', '#ffc107', '#17a2b8', '#ff5722', '#6f42c1', '#ff9800', '#607d8b'], // Couleurs pour les segments
  };

  var pieChart = new ApexCharts(document.querySelector("#equipmentStatsChart"), pieOptions);
  pieChart.render();
});
</script>
@endsection

@section('content')
<div class="row gy-4 justify-content-center">
  <div class="col-xl-8 col-md-12 mb-4">
    <div class="row">
      @foreach ([ 
        ['totalCenters', 'Total Centres', 'fas fa-recycle', 'linear-gradient(45deg, #007bff, #0056b3)'],
        ['topCategory', 'Catégorie Populaire', 'fas fa-star', 'linear-gradient(45deg, #28a745, #218838)'],
        ['totalCategories', 'Total Catégories', 'fas fa-tags', 'linear-gradient(45deg, #ffc107, #e0a800)'],
      ] as [$data, $title, $icon, $bg])
      <div class="col-md-4 mb-4">
        <div class="card text-white text-center shadow" style="background: {{ $bg }}; height: 150px;">
          <div class="card-body d-flex flex-column justify-content-center align-items-center">
            <h2 class="font-weight-bold" style="font-size: 1.5rem;">{{ $$data }}</h2>
            <p class="mb-0">{{ $title }}</p>
            <div class="icon mb-2 mt-3">
              <i class="{{ $icon }} fa-2x"></i>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>

  <div class="col-xl-8 col-md-12 mt-4">
    <div class="card shadow-sm">
      <div class="card-header bg-light">
        <h5 class="mb-0 text-center">Centres de Recyclage par Catégorie</h5>
      </div>
      <div class="card-body">
        <div id="categoryStatsChart" class="text-center"></div> 
      </div>
    </div>
  </div>
</div>

<div class="row gy-4 justify-content-center mt-5">
  <div class="col-xl-8 col-md-12 mb-4">
    <div class="row justify-content-center">
      @foreach ([ 
        ['totalWasteWeight', 'Poids total des déchets', 'fas fa-weight-hanging', 'linear-gradient(45deg, #17a2b8, #117a8b)'],
        ['totalDisposalRecords', 'Total Éliminations', 'fas fa-trash', 'linear-gradient(45deg, #6f42c1, #5a31a8)'],
        ['commonDisposalMethod', 'Méthode Courante', 'fas fa-recycle', 'linear-gradient(45deg, #ff5722, #e64a19)'],
      ] as [$data, $title, $icon, $bg])
      <div class="col-md-4 mb-4">
        <div class="card text-white text-center shadow" style="background: {{ $bg }}; height: 150px;">
          <div class="card-body d-flex flex-column justify-content-center align-items-center">
            <h2 class="font-weight-bold" style="font-size: 1.5rem;">{{ $$data }}</h2>
            <p class="mb-0">{{ $title }}</p>
            <div class="icon mb-2 mt-3">
              <i class="{{ $icon }} fa-2x"></i>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>

  <div class="col-xl-8 col-md-12 mt-4">
    <div class="card shadow-sm">
      <div class="card-header bg-light">
        <h5 class="mb-0 text-center">Équipements par Mois</h5>
      </div>
      <div class="card-body">
        <div id="equipmentStatsChart" class="text-center"></div>
      </div>
    </div>
  </div>
</div>

<div class="row gy-4 justify-content-center mt-5">
  <div class="col-xl-8 col-md-12 mb-4">
    <div class="row justify-content-center">
      @foreach ([ 
        ['equipmentWithMaintenanceCount', 'Équipements avec Maintenance', 'fas fa-tools', 'linear-gradient(45deg, #28a745, #218838)'],
        ['equipmentWithoutMaintenanceCount', 'Équipements sans Maintenance', 'fas fa-exclamation-triangle', 'linear-gradient(45deg, #dc3545, #c82333)'],
      ] as [$data, $title, $icon, $bg])
      <div class="col-md-6 mb-4">
        <div class="card text-white text-center shadow" style="background: {{ $bg }}; height: 150px;">
          <div class="card-body d-flex flex-column justify-content-center align-items-center">
            <h2 class="font-weight-bold" style="font-size: 1.5rem;">{{ $$data }}</h2>
            <p class="mb-0">{{ $title }}</p>
            <div class="icon mb-2 mt-3">
              <i class="{{ $icon }} fa-2x"></i>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="col-md-4 mb-4">
        <div class="card text-white text-center shadow" style="background: linear-gradient(45deg, #28a745, #218838); height: 150px;">
            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                <h2 class="font-weight-bold" style="font-size: 1.5rem;">{{ $totalParticipations }}</h2>
                <p class="mb-0">Total Participations</p>
                <div class="icon mb-2">
                    <i class="fas fa-users fa-2x"></i> 
                </div>
            </div>
        </div>
    </div>
    </div>

   
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header text-center">Participants par Événement</div>
                <div class="card-body">
                    <div id="participantsChart" class="d-flex justify-content-center"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header text-center">Événements par Lieu</div>
                <div class="card-body">
                    <div id="locationsChart" class="d-flex justify-content-center"></div>
                </div>
            </div>
        </div>
    </div>

</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const participantsOptions = {
            chart: {
                type: 'bar',
                height: 350,
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 800,
                },
            },
            series: [{
                name: 'Nombre de Participants',
                data: @json($participantsPerEvent->pluck('participations_count'))
            }],
            xaxis: {
                categories: @json($participantsPerEvent->pluck('name')),
            },
            tooltip: {
                shared: true,
                intersect: false,
            },
            colors: ['#ADD8E6'], 
            dataLabels: {
                enabled: true,
                style: {
                    colors: ['#fff']
                }
            }
        };

        const participantsChart = new ApexCharts(document.querySelector("#participantsChart"), participantsOptions);
        participantsChart.render();
        const locationsOptions = {
            chart: {
                type: 'pie',
                height: 350,
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 800,
                },
            },
            series: @json($eventsByLocation->pluck('total')),
            labels: @json($eventsByLocation->pluck('location')),
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " Événement(s)";
                    }
                }
            },
            colors: ['#D8BFD8', '#98FB98', '#FFB6C1'], 
        };

        const locationsChart = new ApexCharts(document.querySelector("#locationsChart"), locationsOptions);
        locationsChart.render();
    });
</script>
  </div>
</div>
@endsection
