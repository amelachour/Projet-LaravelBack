@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
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
            </div>
          </div>
        </div>
      </div>
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