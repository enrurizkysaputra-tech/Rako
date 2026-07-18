<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'RAKO') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden"
             style="background: linear-gradient(135deg, #14532d 0%, #166534 45%, #15803d 100%);">

           <!-- Pola titik-titik halus di seluruh background -->
            <div class="absolute inset-0" style="background-image: radial-gradient(rgba(255,255,255,0.08) 1.5px, transparent 1.5px); background-size: 28px 28px;"></div>

            <!-- Dekorasi bubble transparan -->
            <div class="absolute rounded-full" style="width: 300px; height: 300px; background: rgba(255,255,255,0.06); top: -100px; left: -100px;"></div>
            <div class="absolute rounded-full" style="width: 200px; height: 200px; background: rgba(255,255,255,0.05); bottom: -60px; right: -60px;"></div>
            <div class="absolute rounded-full" style="width: 120px; height: 120px; background: rgba(255,255,255,0.04); top: 20%; right: 8%;"></div>
            <div class="absolute rounded-full" style="width: 90px; height: 90px; background: rgba(255,255,255,0.05); top: 55%; left: 4%;"></div>
            <div class="absolute rounded-full" style="width: 160px; height: 160px; background: rgba(255,255,255,0.04); top: 70%; right: 15%;"></div>

            <!-- Ikon medis samar, tersebar -->
            <svg class="absolute opacity-10" style="width: 90px; height: 90px; top: 12%; left: 10%;" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12M6 12h12"/>
            </svg>
            <svg class="absolute opacity-10" style="width: 70px; height: 70px; bottom: 15%; left: 8%;" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 3v6a3 3 0 003 3v0a3 3 0 003-3V3M9 12v3a5 5 0 0010 0v-2a2 2 0 10-4 0"/>
                <circle cx="19" cy="7" r="2"/>
            </svg>
            <svg class="absolute opacity-10" style="width: 60px; height: 60px; top: 8%; right: 14%;" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0016.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 002 8.5c0 2.29 1.51 4.04 3 5.5l7 7z"/>
            </svg>
            <svg class="absolute opacity-10" style="width: 55px; height: 55px; bottom: 22%; right: 6%;" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5">
                <rect x="3" y="11" width="18" height="10" rx="2"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 11V7a4 4 0 118 0v1M8 7a4 4 0 018 0"/>
            </svg>
            <svg class="absolute opacity-10" style="width: 45px; height: 45px; top: 45%; left: 15%;" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5">
                <circle cx="12" cy="12" r="9"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v5l3 3"/>
            </svg>

            <div class="mb-4 text-center relative z-10">
                <a href="/" class="inline-flex flex-col items-center">
                    <span class="text-4xl font-bold text-white tracking-wide">RAKO</span>
                    <span class="text-sm text-green-100 mt-1">Reservasi Antrian Klinik Online</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-8 py-8 bg-white shadow-2xl overflow-hidden sm:rounded-2xl border border-green-100 relative z-10">
                {{ $slot }}
            </div>

            <p class="mt-6 text-xs text-green-100 text-center px-4 relative z-10">
                &copy; {{ date('Y') }} RAKO — Reservasi Antrian Klinik Online
            </p>
        </div>
    </body>
</html>