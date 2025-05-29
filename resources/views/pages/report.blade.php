<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>Bus System Reports</h5>
                            <div class="d-flex">
                                <form method="GET" action="{{ route('reports.index') }}" class="d-flex align-items-center me-3">
                                    <div class="me-2">
                                        <label for="start_date" class="form-label mb-0">From</label>
                                        <input type="date" class="form-control form-control-sm" id="start_date" 
                                               name="start_date" value="{{ $startDate }}">
                                    </div>
                                    <div class="me-2">
                                        <label for="end_date" class="form-label mb-0">To</label>
                                        <input type="date" class="form-control form-control-sm" id="end_date" 
                                               name="end_date" value="{{ $endDate }}">
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary mt-3">Filter</button>
                                </form>
                                <a href="{{ route('reports.export') }}?start_date={{ $startDate }}&end_date={{ $endDate }}" 
                                   class="btn btn-sm btn-success mt-3">
                                    <i class="fas fa-download me-1"></i> Export
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="row mb-4">
            {{-- <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Bookings</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ number_format($reportData['total_bookings']) }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fas fa-ticket-alt text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Completed Trips</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ number_format($reportData['completed_trips']) }}
                                        <span class="text-success text-sm font-weight-bolder">
                                            ({{ $reportData['total_bookings'] > 0 ? round(($reportData['completed_trips']/$reportData['total_bookings'])*100, 1) : 0 }}%)
                                        </span>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow text-center border-radius-md">
                                    <i class="fas fa-check-circle text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Cancelled Trips</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ number_format($reportData['cancelled_trips']) }}
                                        <span class="text-danger text-sm font-weight-bolder">
                                            ({{ $reportData['total_bookings'] > 0 ? round(($reportData['cancelled_trips']/$reportData['total_bookings'])*100, 1) : 0 }}%)
                                        </span>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow text-center border-radius-md">
                                    <i class="fas fa-times-circle text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Revenue</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        ${{ number_format($reportData['revenue'], 2) }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                                    <i class="fas fa-dollar-sign text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>

        <!-- Charts Row -->
        <div class="row mb-4">
            <div class="col-lg-8">
                <div class="card z-index-2">
                    <div class="card-header pb-0">
                        <h6>Daily Bookings Trend</h6>
                        <p class="text-sm">
                            <span class="font-weight-bold">From {{ \Carbon\Carbon::parse($startDate)->format('M j, Y') }} to {{ \Carbon\Carbon::parse($endDate)->format('M j, Y') }}</span>
                        </p>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="daily-trend-chart" class="chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6>Monthly Summary ({{ now()->format('Y') }})</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="monthly-summary-chart" class="chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Tables Row -->
        <div class="row">
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="card h-100">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <h6>Top Bus Utilization</h6>
                            <span class="text-sm">Showing top 10</span>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bus Number</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Route</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Capacity</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Bookings</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Utilization</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($busUtilization as $bus)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $bus->bus_number }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $bus->route->name ?? 'N/A' }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $bus->capacity }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-info">{{ $bus->bookings_count }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="progress-wrapper w-75 mx-auto">
                                                <div class="progress-info">
                                                    <div class="progress-percentage">
                                                        <span class="text-xs font-weight-bold">
                                                            {{ $bus->capacity > 0 ? round(($bus->bookings_count/$bus->capacity)*100, 1) : 0 }}%
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-info" role="progressbar" 
                                                         aria-valuenow="{{ $bus->capacity > 0 ? ($bus->bookings_count/$bus->capacity)*100 : 0 }}" 
                                                         aria-valuemin="0" aria-valuemax="100" 
                                                         style="width: {{ $bus->capacity > 0 ? ($bus->bookings_count/$bus->capacity)*100 : 0 }}%;">
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card h-100">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <h6>Route Popularity</h6>
                            <span class="text-sm">Showing top 10</span>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Route</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Stations</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Bookings</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Revenue</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($routePopularity as $route)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $route->name }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">
                                                {{ $route->startingStation->name ?? 'N/A' }} 
                                                <i class="fas fa-arrow-right mx-1"></i> 
                                                {{ $route->endingStation->name ?? 'N/A' }}
                                            </p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-success">{{ $route->bookings_count }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-sm font-weight-bold">${{ number_format($route->bookings->sum('price'), 2) }}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Daily Trend Chart
                var ctx1 = document.getElementById("daily-trend-chart").getContext("2d");
                new Chart(ctx1, {
                    type: "line",
                    data: {
                        labels: @json(array_keys($dailyTrend)),
                        datasets: [{
                            label: "Bookings",
                            tension: 0.4,
                            borderWidth: 2,
                            pointRadius: 3,
                            pointBackgroundColor: "#3A416F",
                            pointBorderColor: "transparent",
                            borderColor: "#3A416F",
                            backgroundColor: "transparent",
                            fill: true,
                            data: @json(array_values($dailyTrend)),
                            maxBarThickness: 6
                        }],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false,
                            }
                        },
                        interaction: {
                            intersect: false,
                            mode: 'index',
                        },
                        scales: {
                            y: {
                                grid: {
                                    drawBorder: false,
                                    display: true,
                                    drawOnChartArea: true,
                                    drawTicks: false,
                                    borderDash: [5, 5],
                                    color: '#c1c4ce5c'
                                },
                                ticks: {
                                    display: true,
                                    padding: 10,
                                    color: '#9ca2b7',
                                    font: {
                                        size: 14,
                                        family: "Open Sans",
                                        style: 'normal',
                                        lineHeight: 2
                                    },
                                }
                            },
                            x: {
                                grid: {
                                    drawBorder: false,
                                    display: true,
                                    drawOnChartArea: true,
                                    drawTicks: false,
                                    borderDash: [5, 5],
                                    color: '#c1c4ce5c'
                                },
                                ticks: {
                                    display: true,
                                    color: '#9ca2b7',
                                    padding: 10,
                                    font: {
                                        size: 14,
                                        family: "Open Sans",
                                        style: 'normal',
                                        lineHeight: 2
                                    },
                                }
                            },
                        },
                    },
                });

                // Monthly Summary Chart
                var ctx2 = document.getElementById("monthly-summary-chart").getContext("2d");
                new Chart(ctx2, {
                    type: "bar",
                    data: {
                        labels: @json(array_keys($monthlySummary)),
                        datasets: [{
                            label: "Bookings",
                            tension: 0.4,
                            borderWidth: 0,
                            borderRadius: 4,
                            borderSkipped: false,
                            backgroundColor: "#3A416F",
                            data: @json(array_column($monthlySummary, 'bookings')),
                            maxBarThickness: 6
                        }, {
                            label: "Cancellations",
                            tension: 0.4,
                            borderWidth: 0,
                            borderRadius: 4,
                            borderSkipped: false,
                            backgroundColor: "#F44336",
                            data: @json(array_column($monthlySummary, 'cancellations')),
                            maxBarThickness: 6
                        }],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                        },
                        interaction: {
                            intersect: false,
                            mode: 'index',
                        },
                        scales: {
                            y: {
                                grid: {
                                    drawBorder: false,
                                    display: true,
                                    drawOnChartArea: true,
                                    drawTicks: false,
                                    borderDash: [5, 5],
                                    color: '#c1c4ce5c'
                                },
                                ticks: {
                                    display: true,
                                    padding: 10,
                                    color: '#9ca2b7',
                                    font: {
                                        size: 14,
                                        family: "Open Sans",
                                        style: 'normal',
                                        lineHeight: 2
                                    },
                                }
                            },
                            x: {
                                grid: {
                                    drawBorder: false,
                                    display: false,
                                    drawOnChartArea: false,
                                    drawTicks: false,
                                },
                                ticks: {
                                    display: true,
                                    color: '#9ca2b7',
                                    padding: 10,
                                    font: {
                                        size: 14,
                                        family: "Open Sans",
                                        style: 'normal',
                                        lineHeight: 2
                                    },
                                }
                            },
                        },
                    },
                });
            });
        </script>
    @endpush
</x-app-layout>