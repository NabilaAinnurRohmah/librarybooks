<!DOCTYPE html>
<html>

<head>
    <title>Perpustakaan</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        .menu-group {
            margin-top: 20px;
        }

        .menu-title {
            font-size: 14px;
            font-weight: bold;
            color: #999;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
    </style>
</head>

<body>

    @if (session('role') == 'admin')
        @include('partials.sidebar-admin')
    @else
        @include('partials.sidebar-peminjam')
    @endif

    <div class="main">

        <div class="topbar">
            Welcome {{ session('user') }} 👋
        </div>

        <div class="content">
            @yield('content')
        </div>

    </div>

</body>

</html>
