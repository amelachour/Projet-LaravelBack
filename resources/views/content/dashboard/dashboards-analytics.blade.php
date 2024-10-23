@extends('layouts/contentNavbarLayout')

@section('title', 'Statistiques des événements')

@section('vendor-style')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
@endsection
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

@section('content')
<body>
    <h4 class="py-3 mb-4 text-center"><span class="text-muted fw-light">Statistiques</span></h4>

    
    <div class="row justify-content-center mb-4">
    <div class="col-md-4 mb-4">
        <div class="card text-white text-center shadow" style="background: linear-gradient(45deg, #007bff, #0056b3); height: 150px;">
            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                <h2 class="font-weight-bold" style="font-size: 1.5rem;">{{ $totalEvents }}</h2>
                <p class="mb-0">Total Événements</p>
                <div class="icon mb-2">
                    <i class="fas fa-calendar-alt fa-2x"></i> 
                </div>
            </div>
        </div>
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
@endsection

