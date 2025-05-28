<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @auth
                @if(auth()->user()->hasRole('admin'))
                    Admin -
                @elseif(auth()->user()->hasRole('driver'))
                    Driver -
                @elseif(auth()->user()->hasRole('passenger'))
                    Passenger -
                @endif                
            @endauth
            
            BusPulse - Tap, Track, Travel
    </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('styles.css')}}">
    <link rel="icon" type="text/css" href="{{asset('images/icon.png')}}">
    <link rel="stylesheet" href="{{ asset('leaflet/leaflet.css') }}">
</head>