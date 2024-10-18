@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
<<<<<<< HEAD
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
=======
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')
<div class="row gy-4">
  
  <!-- Weekly Overview Chart -->
  <div class="col-xl-4 col-md-6">
    <div class="card">
      <div class="card-header">
        <div class="d-flex justify-content-between">
          <h5 class="mb-1">Weekly Overview</h5>
          <div class="dropdown">
            <button class="btn p-0" type="button" id="weeklyOverviewDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="mdi mdi-dots-vertical mdi-24px"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="weeklyOverviewDropdown">
              <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
              <a class="dropdown-item" href="javascript:void(0);">Share</a>
              <a class="dropdown-item" href="javascript:void(0);">Update</a>
>>>>>>> origin/main
            </div>
          </div>
        </div>
      </div>
<<<<<<< HEAD
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
  </div>
</div>
@endsection
=======
      <div class="card-body">
        <div id="weeklyOverviewChart"></div>
        <div class="mt-1 mt-md-3">
          <div class="d-flex align-items-center gap-3">
            <h3 class="mb-0">45%</h3>
            <p class="mb-0">Your sales performance is 45% 😎 better compared to last month</p>
          </div>
          <div class="d-grid mt-3 mt-md-4">
            <button class="btn btn-primary" type="button">Details</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Weekly Overview Chart -->




  <!-- Data Tables -->
  <div class="col-12">
    <div class="card">
      <div class="table-responsive">
        <table class="table">
          <thead class="table-light">
            <tr>
              <th class="text-truncate">User</th>
              <th class="text-truncate">Email</th>
              <th class="text-truncate">Role</th>
              <th class="text-truncate">Age</th>
              <th class="text-truncate">Salary</th>
              <th class="text-truncate">Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-sm me-3">
                    <img src="{{asset('assets/img/avatars/1.png')}}" alt="Avatar" class="rounded-circle">
                  </div>
                  <div>
                    <h6 class="mb-0 text-truncate">Jordan Stevenson</h6>
                    <small class="text-truncate">@amiccoo</small>
                  </div>
                </div>
              </td>
              <td class="text-truncate">susanna.Lind57@gmail.com</td>
              <td class="text-truncate"><i class="mdi mdi-laptop mdi-24px text-danger me-1"></i> Admin</td>
              <td class="text-truncate">24</td>
              <td class="text-truncate">34500$</td>
              <td><span class="badge bg-label-warning rounded-pill">Pending</span></td>
            </tr>
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-sm me-3">
                    <img src="{{asset('assets/img/avatars/3.png')}}" alt="Avatar" class="rounded-circle">
                  </div>
                  <div>
                    <h6 class="mb-0 text-truncate">Benedetto Rossiter</h6>
                    <small class="text-truncate">@brossiter15</small>
                  </div>
                </div>
              </td>
              <td class="text-truncate">estelle.Bailey10@gmail.com</td>
              <td class="text-truncate"><i class="mdi mdi-pencil-outline text-info mdi-24px me-1"></i> Editor</td>
              <td class="text-truncate">29</td>
              <td class="text-truncate">64500$</td>
              <td><span class="badge bg-label-success rounded-pill">Active</span></td>
            </tr>
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-sm me-3">
                    <img src="{{asset('assets/img/avatars/2.png')}}" alt="Avatar" class="rounded-circle">
                  </div>
                  <div>
                    <h6 class="mb-0 text-truncate">Bentlee Emblin</h6>
                    <small class="text-truncate">@bemblinf</small>
                  </div>
                </div>
              </td>
              <td class="text-truncate">milo86@hotmail.com</td>
              <td class="text-truncate"><i class="mdi mdi-cog-outline text-warning mdi-24px me-1"></i> Author</td>
              <td class="text-truncate">44</td>
              <td class="text-truncate">94500$</td>
              <td><span class="badge bg-label-success rounded-pill">Active</span></td>
            </tr>
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-sm me-3">
                    <img src="{{asset('assets/img/avatars/5.png')}}" alt="Avatar" class="rounded-circle">
                  </div>
                  <div>
                    <h6 class="mb-0 text-truncate">Bertha Biner</h6>
                    <small class="text-truncate">@bbinerh</small>
                  </div>
                </div>
              </td>
              <td class="text-truncate">lonnie35@hotmail.com</td>
              <td class="text-truncate"><i class="mdi mdi-pencil-outline text-info mdi-24px me-1"></i> Editor</td>
              <td class="text-truncate">19</td>
              <td class="text-truncate">4500$</td>
              <td><span class="badge bg-label-warning rounded-pill">Pending</span></td>
            </tr>
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-sm me-3">
                    <img src="{{asset('assets/img/avatars/4.png')}}" alt="Avatar" class="rounded-circle">
                  </div>
                  <div>
                    <h6 class="mb-0 text-truncate">Beverlie Krabbe</h6>
                    <small class="text-truncate">@bkrabbe1d</small>
                  </div>
                </div>
              </td>
              <td class="text-truncate">ahmad_Collins@yahoo.com</td>
              <td class="text-truncate"><i class="mdi mdi-chart-donut mdi-24px text-success me-1"></i> Maintainer</td>
              <td class="text-truncate">22</td>
              <td class="text-truncate">10500$</td>
              <td><span class="badge bg-label-success rounded-pill">Active</span></td>
            </tr>
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-sm me-3">
                    <img src="{{asset('assets/img/avatars/7.png')}}" alt="Avatar" class="rounded-circle">
                  </div>
                  <div>
                    <h6 class="mb-0 text-truncate">Bradan Rosebotham</h6>
                    <small class="text-truncate">@brosebothamz</small>
                  </div>
                </div>
              </td>
              <td class="text-truncate">tillman.Gleason68@hotmail.com</td>
              <td class="text-truncate"><i class="mdi mdi-pencil-outline text-info mdi-24px me-1"></i> Editor</td>
              <td class="text-truncate">50</td>
              <td class="text-truncate">99500$</td>
              <td><span class="badge bg-label-warning rounded-pill">Pending</span></td>
            </tr>
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-sm me-3">
                    <img src="{{asset('assets/img/avatars/6.png')}}" alt="Avatar" class="rounded-circle">
                  </div>
                  <div>
                    <h6 class="mb-0 text-truncate">Bree Kilday</h6>
                    <small class="text-truncate">@bkildayr</small>
                  </div>
                </div>
              </td>
              <td class="text-truncate">otho21@gmail.com</td>
              <td class="text-truncate"><i class="mdi mdi-account-outline mdi-24px text-primary me-1"></i> Subscriber</td>
              <td class="text-truncate">23</td>
              <td class="text-truncate">23500$</td>
              <td><span class="badge bg-label-success rounded-pill">Active</span></td>
            </tr>
            <tr class="border-transparent">
              <td>
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-sm me-3">
                    <img src="{{asset('assets/img/avatars/1.png')}}" alt="Avatar" class="rounded-circle">
                  </div>
                  <div>
                    <h6 class="mb-0 text-truncate">Breena Gallemore</h6>
                    <small class="text-truncate">@bgallemore6</small>
                  </div>
                </div>
              </td>
              <td class="text-truncate">florencio.Little@hotmail.com</td>
              <td class="text-truncate"><i class="mdi mdi-account-outline mdi-24px text-primary me-1"></i> Subscriber</td>
              <td class="text-truncate">33</td>
              <td class="text-truncate">20500$</td>
              <td><span class="badge bg-label-secondary rounded-pill">Inactive</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!--/ Data Tables -->
</div>
@endsection
>>>>>>> origin/main
