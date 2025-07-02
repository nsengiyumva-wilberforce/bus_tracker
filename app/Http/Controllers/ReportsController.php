<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Route;
use App\Models\User;
use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        // Date range handling
        $startDate = $request->input('start_date', now()->subMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->format('Y-m-d'));

        // Main statistics
        $reportData = [
            'total_bookings' => Book::whereBetween('departure_time', [$startDate, $endDate])->count(),
            'completed_trips' => Book::where('status', 'arrived')
                ->whereBetween('departure_time', [$startDate, $endDate])
                ->count(),
            'cancelled_trips' => Book::where('status', 'cancelled')
                ->whereBetween('departure_time', [$startDate, $endDate])
                ->count(),
            'revenue' => Book::whereBetween('departure_time', [$startDate, $endDate])
                ->sum('price'),
        ];

        // Bus utilization report
        $busUtilization = Bus::withCount(['bookings' => function ($query) use ($startDate, $endDate) {
            $query->whereBetween('departure_time', [$startDate, $endDate]);
        }])
            ->orderBy('bookings_count', 'desc')
            ->limit(10)
            ->get();

        // Route popularity report
        $routePopularity = Route::withCount(['bookings' => function ($query) use ($startDate, $endDate) {
            $query->whereBetween('departure_time', [$startDate, $endDate]);
        }])
            ->orderBy('bookings_count', 'desc')
            ->limit(10)
            ->get();

        // Daily bookings trend
        $dailyTrend = $this->getDailyBookingsTrend($startDate, $endDate);

        // Monthly summary
        $monthlySummary = $this->getMonthlySummary();

        return view('pages.report', compact(
            'reportData',
            'busUtilization',
            'routePopularity',
            'dailyTrend',
            'monthlySummary',
            'startDate',
            'endDate'
        ));
    }

    protected function getDailyBookingsTrend($startDate, $endDate)
    {
        $dates = [];
        $currentDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate);

        while ($currentDate <= $endDate) {
            $dates[$currentDate->format('Y-m-d')] = 0;
            $currentDate->addDay();
        }

        $bookings = Book::whereBetween('departure_time', [$startDate, $endDate])
            ->selectRaw('DATE(departure_time) as date, COUNT(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date');

        return array_replace($dates, $bookings->toArray());
    }

    protected function getMonthlySummary()
    {
        $months = [];
        $currentMonth = now()->startOfYear();

        for ($i = 0; $i < 12; $i++) {
            $monthKey = $currentMonth->format('Y-m');
            $months[$currentMonth->format('M Y')] = [
                'bookings' => 0,
                'revenue' => 0,
                'cancellations' => 0
            ];
            $currentMonth->addMonth();
        }

        // Bookings and revenue
        $monthlyData = Book::selectRaw('DATE_FORMAT(departure_time, "%Y-%m") as month, 
                           COUNT(*) as bookings, 
                           SUM(price) as revenue')
            ->where('departure_time', '>=', now()->startOfYear())
            ->groupBy('month')
            ->get()
            ->keyBy('month');

        // Cancellations
        $cancellations = Book::where('status', 'cancelled')
            ->selectRaw('DATE_FORMAT(departure_time, "%Y-%m") as month, 
                                      COUNT(*) as count')
            ->where('departure_time', '>=', now()->startOfYear())
            ->groupBy('month')
            ->pluck('count', 'month');

        foreach ($monthlyData as $month => $data) {
            $monthName = Carbon::createFromFormat('Y-m', $month)->format('M Y');
            $months[$monthName] = [
                'bookings' => $data->bookings,
                'revenue' => $data->revenue,
                'cancellations' => $cancellations[$month] ?? 0
            ];
        }

        return $months;
    }

    public function export(Request $request)
    {
        // Implement your export logic here (CSV, PDF, Excel)
        // This would typically return a download response
    }
}
