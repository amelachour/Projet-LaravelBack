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

      // Chart for Posts, Likes, and Comments
      var postOptions = {
        series: [{
          name: 'Nombre',
          data: [@json($totalPosts), @json($totalLikes), @json($totalComments)]
        }],
        chart: {
          type: 'bar',
          height: 250
        },
        plotOptions: {
          bar: {
            borderRadius: 8,
            horizontal: false,
          },
        },
        xaxis: {
          categories: ['Posts', 'Likes', 'Comments'],
        }
      };

      var postChart = new ApexCharts(document.querySelector("#postStatsChart"), postOptions);
      postChart.render();
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

  <!-- New Section for Posts, Likes, and Comments -->
  <div class="row gy-4 justify-content-center mt-5">
    <div class="col-xl-8 col-md-12 mb-4">
      <div class="row justify-content-center">
        @foreach ([
          ['totalPosts', 'Total Posts', 'fas fa-sticky-note', 'linear-gradient(45deg, #007bff, #0056b3)'],
          ['totalLikes', 'Total Likes', 'fas fa-heart', 'linear-gradient(45deg, #e74c3c, #c0392b)'],
          ['totalComments', 'Total Comments', 'fas fa-comments', 'linear-gradient(45deg, #17a2b8, #117a8b)'],
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
          <h5 class="mb-0 text-center">Posts, Likes & Comments</h5>
        </div>
        <div class="card-body">
          <div id="postStatsChart" class="text-center"></div>
        </div>
      </div>
    </div>
  </div>
@endsection
