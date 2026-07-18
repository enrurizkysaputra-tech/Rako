<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RAKO - @yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .rako-navbar {
            background: linear-gradient(135deg, #14532d 0%, #15803d 100%);
        }
        .rako-brand {
            font-size: 2rem;
            letter-spacing: 1px;
        }
        .rako-menu-wrapper {
            position: relative;
        }
        .rako-menu-toggle {
            background: transparent;
            border: none;
            color: #fff;
            font-size: 1.6rem;
            line-height: 1;
            padding: 0.35rem 0.7rem;
            cursor: pointer;
            border-radius: 0.4rem;
            transition: background-color 0.2s ease;
        }
        .rako-menu-toggle:hover {
            background-color: rgba(255,255,255,0.15);
        }
        .rako-menu-panel {
            position: absolute;
            top: 100%;
            left: 0;
            min-width: 240px;
            background: #fff;
            border-radius: 0.6rem;
            box-shadow: 0 12px 28px rgba(0,0,0,0.2);
            padding: 0.5rem 0;
            margin-top: 0.5rem;
            opacity: 0;
            transform: translateY(-12px);
            pointer-events: none;
            transition: opacity 0.25s ease, transform 0.25s ease;
            z-index: 1050;
        }
        .rako-menu-wrapper:hover .rako-menu-panel,
        .rako-menu-wrapper.force-show .rako-menu-panel {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }
        .rako-menu-panel a {
            display: block;
            padding: 0.65rem 1.25rem;
            color: #14532d;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.15s ease, color 0.15s ease;
        }
        .rako-menu-panel a:hover {
            background: #f0fdf4;
            color: #15803d;
        }
        .rako-nav-link {
            border-radius: 0.4rem;
            transition: background-color 0.2s ease, transform 0.2s ease;
        }
        .rako-nav-link:hover {
            background-color: rgba(255,255,255,0.18);
            transform: translateY(-2px);
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark rako-navbar">
        <div class="container d-flex align-items-center">

            @auth
                @if(in_array(auth()->user()->role, ['admin', 'dokter']))
                <div class="rako-menu-wrapper me-3" id="rakoMenuWrapper">
                    <button class="rako-menu-toggle" type="button" onclick="document.getElementById('rakoMenuWrapper').classList.toggle('force-show')">
                        &#9776;
                    </button>
                    <div class="rako-menu-panel">
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
                            <a href="{{ route('admin.doctors.index') }}">Data Dokter</a>
                            <a href="{{ route('admin.appointments.index') }}">Semua Reservasi</a>
                        @else
                            <a href="{{ route('doctor.appointments.index') }}">Reservasi Masuk</a>
                            <a href="{{ route('doctor.schedules.index') }}">Jadwal Praktik</a>
                        @endif
                    </div>
                </div>
                @endif
            @endauth

            <a class="navbar-brand fw-bold rako-brand" href="{{ route('dashboard') }}">RAKO</a>

            <ul class="navbar-nav ms-auto d-flex flex-row align-items-center gap-2">
                @auth
                    @if(auth()->user()->role === 'pasien')
                        <li class="nav-item"><a class="nav-link" href="{{ route('patient.doctors.index') }}">Cari Dokter</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('patient.bookings.index') }}">Riwayat Reservasi</a></li>
                    @endif
                    <li class="nav-item"><a class="nav-link" href="{{ route('profile.edit') }}">Edit Profil</a></li>
                    
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-outline-light btn-sm ms-2" type="submit">Logout</button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>

    <div class="container py-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>