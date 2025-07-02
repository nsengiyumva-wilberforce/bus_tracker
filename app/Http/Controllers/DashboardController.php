<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Route;
use App\Models\User;
use App\Models\Book;
use App\Models\BusStop;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Bus statistics
        $totalBuses = Bus::count();
        $onTransitBuses = Bus::where('status', 'On Time')->count();
        $delayedBuses = Bus::where('status', 'Delayed')->count();
        
        // Commuter statistics
        $totalCommuters = User::count();
        $activeCommuters = User::whereHas('bookings', function($query) {
            $query->where('departure_time', '>=', now()->subDays(7));
        })->count();
        
        // Weekly commuters data
        $weeklyCommuters = $this->getWeeklyCommutersData();
        
        // Unexpected stops data (using bookings with cancelled status as proxy)
        $unexpectedStops = $this->getUnexpectedStopsData();
        
        // Commuters per route
        $commutersPerRoute = $this->getCommutersPerRoute();
        
        // Time table data
        $routes = Route::with(['startingStation', 'endingStation', 'buses'])
                      ->orderBy('name')
                      ->get();
        
        // Recent bookings
        $recentBookings = Book::with(['user', 'route', 'bus'])
                            ->orderBy('departure_time', 'desc')
                            ->limit(5)
                            ->get();
        
        return view('pages.dashboard', compact(
            'totalBuses',
            'onTransitBuses',
            'delayedBuses',
            'totalCommuters',
            'activeCommuters',
            'weeklyCommuters',
            'unexpectedStops',
            'commutersPerRoute',
            'routes',
            'recentBookings'
        ));
    }
    
    protected function getWeeklyCommutersData()
    {
        $data = [];
        $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        
        foreach ($days as $index => $day) {
            $start = now()->startOfWeek()->addDays($index);
            $end = $start->copy()->endOfDay();
            
            $data[$day] = Book::whereBetween('departure_time', [$start, $end])
                             ->count();
        }
        
        return $data;
    }
    
    protected function getUnexpectedStopsData()
    {
        $data = [];
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        
        foreach ($months as $index => $month) {
            $start = now()->startOfYear()->addMonths($index);
            $end = $start->copy()->endOfMonth();
            
            $data[$month] = Book::where('status', 'cancelled')
                               ->whereBetween('departure_time', [$start, $end])
                               ->count();
        }
        
        return $data;
    }
    
    protected function getCommutersPerRoute()
    {
        return Route::withCount(['bookings' => function($query) {
            $query->where('departure_time', '>=', now()->subMonth());
        }])
        ->orderBy('bookings_count', 'desc')
        ->limit(5)
        ->get()
        ->pluck('bookings_count', 'name')
        ->toArray();
    }
}