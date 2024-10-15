@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script>
document.addEventListener('DOMContentLoaded', function () {
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
});
</script>
@endsection

@section('content')
<div class="row gy-4 justify-content-center">
  <div class="col-xl-8 col-md-12 mb-4">
    <div class="row justify-content-center">
      <div class="col-md-4 mb-4">
        <div class="card text-white text-center shadow" style="background: linear-gradient(45deg, #007bff, #0056b3); height: 150px;">
          <div class="card-body d-flex flex-column justify-content-center align-items-center">
            <h2 class="font-weight-bold" style="font-size: 1.5rem;">{{ $totalCenters }}</h2>
            <p class="mb-0">Total Centres</p>
            <div class="icon mb-2">
              <i class="fas fa-recycle fa-2x"></i>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4 mb-4">
        <div class="card text-white text-center shadow" style="background: linear-gradient(45deg, #28a745, #218838); height: 150px;">
          <div class="card-body d-flex flex-column justify-content-center align-items-center">
            <h2 class="font-weight-bold" style="font-size: 1.5rem;">{{ $topCategory }}</h2>
            <p class="mb-0">Catégorie la plus populaire</p>
            <div class="icon mb-2">
              <i class="fas fa-star fa-2x"></i>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4 mb-4">
        <div class="card text-white text-center shadow" style="background: linear-gradient(45deg, #ffc107, #e0a800); height: 150px;">
          <div class="card-body d-flex flex-column justify-content-center align-items-center">
            <h2 class="font-weight-bold" style="font-size: 1.5rem;">{{ $totalCategories }}</h2>
            <p class="mb-0">Total Catégories</p>
            <div class="icon mb-2">
              <i class="fas fa-tags fa-2x"></i>
            </div>
          </div>
        </div>
      </div>
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

<style>
    body {
        background-color: #f8f9fa; 
    }
    .card {
        transition: transform 0.2s; 
        border-radius: 1rem; 
    }
    .card:hover {
        transform: scale(1.05); 
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3); 
    }
    .icon {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
@endsection
