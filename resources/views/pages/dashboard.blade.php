<x-app-layout>
    <div class="container-fluid py-2">
        <div class="row">
            <div class="ms-3">
                <h3 class="mb-0 h4 font-weight-bolder">Dashboard</h3>
                <p class="mb-4">
                    Bus Pulse Analytics Dashboard - {{ now()->format('F j, Y') }}
                </p>
            </div>
            
            <!-- Statistics Cards -->
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-2 ps-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-sm mb-0 text-capitalize">Total Buses</p>
                                <h4 class="mb-0">{{ $totalBuses }}</h4>
                            </div>
                            <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                                <i class="material-symbols-rounded opacity-10">directions_bus</i>
                            </div>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-2 ps-3">
                        <p class="mb-0 text-sm">
                            <span class="text-success font-weight-bolder">{{ number_format(($onTransitBuses/$totalBuses)*100, 1) }}% </span>on transit
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-2 ps-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-sm mb-0 text-capitalize">On Transit</p>
                                <h4 class="mb-0">{{ $onTransitBuses }}</h4>
                            </div>
                            <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                                <i class="material-symbols-rounded opacity-10">departure_board</i>
                            </div>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-2 ps-3">
                        <p class="mb-0 text-sm">
                            <span class="{{ $delayedBuses > 0 ? 'text-danger' : 'text-success' }} font-weight-bolder">{{ $delayedBuses }}</span> delayed buses
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-2 ps-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-sm mb-0 text-capitalize">Active Commuters</p>
                                <h4 class="mb-0">{{ $activeCommuters }}</h4>
                            </div>
                            <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                                <i class="material-symbols-rounded opacity-10">group</i>
                            </div>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-2 ps-3">
                        <p class="mb-0 text-sm">
                            <span class="text-success font-weight-bolder">{{ number_format(($activeCommuters/$totalCommuters)*100, 1) }}% </span>of total commuters
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-header p-2 ps-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-sm mb-0 text-capitalize">Total Commuters</p>
                                <h4 class="mb-0">{{ $totalCommuters }}</h4>
                            </div>
                            <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                                <i class="material-symbols-rounded opacity-10">people</i>
                            </div>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-2 ps-3">
                        <p class="mb-0 text-sm">
                            <span class="text-success font-weight-bolder">+{{ rand(5, 15) }}% </span>than last month
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Charts Row -->
        <div class="row mt-4">
            <div class="col-lg-4 col-md-6 mt-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-0">Commuters This Week</h6>
                        <p class="text-sm">Passengers we have moved this week</p>
                        <div class="pe-2">
                            <div class="chart">
                                <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                            </div>
                        </div>
                        <hr class="dark horizontal">
                        <div class="d-flex">
                            <i class="material-symbols-rounded text-sm my-auto me-1">schedule</i>
                            <p class="mb-0 text-sm">Updated {{ now()->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mt-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-0">Service Disruptions</h6>
                        <p class="text-sm">Cancellations and delays this year</p>
                        <div class="pe-2">
                            <div class="chart">
                                <canvas id="chart-line" class="chart-canvas" height="170"></canvas>
                            </div>
                        </div>
                        <hr class="dark horizontal">
                        <div class="d-flex">
                            <i class="material-symbols-rounded text-sm my-auto me-1">schedule</i>
                            <p class="mb-0 text-sm">Updated {{ now()->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 mt-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-0">Commuters Per Route</h6>
                        <p class="text-sm">Top routes by passenger count</p>
                        <div class="pe-2">
                            <div class="chart">
                                <canvas id="chart-line-tasks" class="chart-canvas" height="170"></canvas>
                            </div>
                        </div>
                        <hr class="dark horizontal">
                        <div class="d-flex">
                            <i class="material-symbols-rounded text-sm my-auto me-1">schedule</i>
                            <p class="mb-0 text-sm">Updated {{ now()->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Tables Row -->
        <div class="row mb-4">
            <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-lg-6 col-7">
                                <h6>Time Table</h6>
                                <p class="text-sm mb-0">
                                    <i class="fa fa-check text-info" aria-hidden="true"></i>
                                    <span class="font-weight-bold ms-1">Bus Schedule</span> by route
                                </p>
                            </div>
                            <div class="col-lg-6 col-5 my-auto text-end">
                                <div class="dropdown float-lg-end pe-4">
                                    <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v text-secondary"></i>
                                    </a>
                                    <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable">
                                        <li><a class="dropdown-item border-radius-md" href="{{ route('routes.index') }}">View All Routes</a></li>
                                        <li><a class="dropdown-item border-radius-md" href="{{ route('buses.index') }}">View All Buses</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Route</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Stations</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Time Table</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Buses</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($routes as $route)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $route->name }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-sm mb-0">
                                                    {{ $route->startingStation->name ?? 'N/A' }} 
                                                    <i class="fas fa-arrow-right mx-2"></i> 
                                                    {{ $route->endingStation->name ?? 'N/A' }}
                                                </p>
                                            </td>
                                            <td>
                                                @if($route->timetable)
                                                    @foreach (json_decode($route->timetable) as $time)
                                                        <span class="badge bg-info">{{ $time }}</span>
                                                    @endforeach
                                                @else
                                                    <span class="badge bg-warning">Not set</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-success">{{ $route->buses->count() }}</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No routes have been registered</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="card-header pb-0">
                        <h6>Recent Bookings</h6>
                        <p class="text-sm mb-0">
                            <i class="fa fa-check text-info" aria-hidden="true"></i>
                            <span class="font-weight-bold ms-1">Latest {{ count($recentBookings) }}</span> bookings
                        </p>
                    </div>
                    <div class="card-body p-3">
                        <div class="timeline timeline-one-side">
                            @foreach($recentBookings as $booking)
                                <div class="timeline-block mb-3">
                                    <span class="timeline-step">
                                        <i class="material-symbols-rounded text-success text-gradient">event_available</i>
                                    </span>
                                    <div class="timeline-content">
                                        <h6 class="text-dark text-sm font-weight-bold mb-0">
                                            {{ $booking->user->first_name }} {{ $booking->user->last_name }}
                                        </h6>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                            {{ $booking->route->name }} - 
                                            {{ \Carbon\Carbon::parse($booking->departure_time)->format('M j, g:i A') }}
                                        </p>
                                        <span class="badge badge-sm {{ $booking->status === 'scheduled' ? 'bg-info' : ($booking->status === 'boarding' ? 'bg-warning' : ($booking->status === 'departed' ? 'bg-primary' : ($booking->status === 'arrived' ? 'bg-success' : 'bg-danger'))) }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Weekly Commuters Chart
                var ctx = document.getElementById("chart-bars").getContext("2d");
                new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: @json(array_keys($weeklyCommuters)),
                        datasets: [{
                            label: "Commuters",
                            tension: 0.4,
                            borderWidth: 0,
                            borderRadius: 4,
                            borderSkipped: false,
                            backgroundColor: "#43A047",
                            data: @json(array_values($weeklyCommuters)),
                            barThickness: 'flex'
                        }],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        interaction: { intersect: false, mode: 'index' },
                        scales: {
                            y: {
                                grid: {
                                    drawBorder: false,
                                    display: true,
                                    drawOnChartArea: true,
                                    drawTicks: false,
                                    borderDash: [5, 5],
                                    color: '#e5e5e5'
                                },
                                ticks: {
                                    suggestedMin: 0,
                                    suggestedMax: Math.max(...@json(array_values($weeklyCommuters))) * 1.2,
                                    beginAtZero: true,
                                    padding: 10,
                                    font: { size: 14, lineHeight: 2 },
                                    color: "#737373"
                                },
                            },
                            x: {
                                grid: {
                                    drawBorder: false,
                                    display: false,
                                    drawOnChartArea: false,
                                    drawTicks: false,
                                    borderDash: [5, 5]
                                },
                                ticks: {
                                    display: true,
                                    color: '#737373',
                                    padding: 10,
                                    font: { size: 14, lineHeight: 2 },
                                }
                            },
                        },
                    },
                });

                // Service Disruptions Chart
                var ctx2 = document.getElementById("chart-line").getContext("2d");
                new Chart(ctx2, {
                    type: "line",
                    data: {
                        labels: @json(array_keys($unexpectedStops)),
                        datasets: [{
                            label: "Disruptions",
                            tension: 0,
                            borderWidth: 2,
                            pointRadius: 3,
                            pointBackgroundColor: "#43A047",
                            pointBorderColor: "transparent",
                            borderColor: "#43A047",
                            backgroundColor: "transparent",
                            fill: true,
                            data: @json(array_values($unexpectedStops)),
                            maxBarThickness: 6
                        }],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    title: function(context) {
                                        const fullMonths = ["January", "February", "March", "April", "May", "June",
                                            "July", "August", "September", "October", "November", "December"
                                        ];
                                        return fullMonths[context[0].dataIndex];
                                    }
                                }
                            }
                        },
                        interaction: { intersect: false, mode: 'index' },
                        scales: {
                            y: {
                                grid: {
                                    drawBorder: false,
                                    display: true,
                                    drawOnChartArea: true,
                                    drawTicks: false,
                                    borderDash: [4, 4],
                                    color: '#e5e5e5'
                                },
                                ticks: {
                                    display: true,
                                    color: '#737373',
                                    padding: 10,
                                    font: { size: 12, lineHeight: 2 },
                                }
                            },
                            x: {
                                grid: {
                                    drawBorder: false,
                                    display: false,
                                    drawOnChartArea: false,
                                    drawTicks: false,
                                    borderDash: [5, 5]
                                },
                                ticks: {
                                    display: true,
                                    color: '#737373',
                                    padding: 10,
                                    font: { size: 12, lineHeight: 2 },
                                }
                            },
                        },
                    },
                });

                // Commuters Per Route Chart
                var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");
                new Chart(ctx3, {
                    type: "doughnut",
                    data: {
                        labels: @json(array_keys($commutersPerRoute)),
                        datasets: [{
                            label: "Commuters",
                            backgroundColor: ["#43A047", "#2E7D32", "#1B5E20", "#81C784", "#C8E6C9"],
                            data: @json(array_values($commutersPerRoute)),
                            maxBarThickness: 6
                        }],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { position: 'right' } },
                        interaction: { intersect: false, mode: 'index' },
                        cutout: '60%',
                    },
                });
            });
        </script>
    @endpush
</x-app-layout>