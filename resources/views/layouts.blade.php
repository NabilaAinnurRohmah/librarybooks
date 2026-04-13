<!DOCTYPE html>
<html>

<head>
    <title>Perpustakaan</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            margin: 0;
            font-family: Arial;
            display: flex;
        }

        .sidebar {
            width: 220px;
            height: 100vh;
            background: #2c3e50;
            color: white;
            position: fixed;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background: #34495e;
        }

        .main {
            margin-left: 220px;
            width: 100%;
        }

        .topbar {
            background: #ecf0f1;
            padding: 15px 20px;
            font-size: 18px;
            font-weight: bold;
        }

        .content {
            padding: 20px;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h2 style="text-align:center; background:rgb(56, 99, 56); padding:10px;">Menu</h2>
        <a href="/dashboard">Dashboard</a>
        <a href="/buku">Buku</a>
        <a href="/kategori">Kategori</a>
        <a href="/logout">Logout</a>
    </div>

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
