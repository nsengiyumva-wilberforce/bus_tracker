<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Manage Bookings</h2>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Booking ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Passenger Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bus Number</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Route</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Departure Time</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php
                        // Separate bookings into upcoming and past
                        $upcomingBookings = $bookings->filter(function($booking) {
                            return \Carbon\Carbon::parse($booking->departure_time)->isFuture();
                        });
                        
                        $pastBookings = $bookings->filter(function($booking) {
                            return \Carbon\Carbon::parse($booking->departure_time)->isPast();
                        });
                    @endphp
                    
                    <!-- Upcoming Bookings -->
                    @foreach ($upcomingBookings->sortBy('departure_time') as $booking)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $booking->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $booking->user->first_name.' '.$booking->user->last_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $booking->bus->bus_number }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $booking->route->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($booking->departure_time)->format('M d, Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Upcoming
                                </span>
                            </td>
                        </tr>
                    @endforeach
                    
                    <!-- Past Bookings -->
                    @foreach ($pastBookings->sortByDesc('departure_time') as $booking)
                        <tr class="hover:bg-gray-50 bg-gray-50 text-gray-400">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ $booking->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $booking->user->first_name.' '.$booking->user->last_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $booking->bus->bus_number }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $booking->route->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                {{ $booking->departure_time }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    Completed
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($bookings->isEmpty())
            <div class="text-center py-8 text-gray-500">
                No bookings found.
            </div>
        @endif
    </div>
</x-app-layout>