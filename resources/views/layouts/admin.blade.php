<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>

    <style>
        body {
            margin: 0;
            font-family: Arial;
            display: flex;
        }

        /* SIDEBAR */
        .sidebar {
            width: 220px;
            background: #e91e63;
            color: white;
            height: 100vh;
            padding: 20px;
        }

        .sidebar h2 {
            margin-bottom: 20px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 8px;
        }

        .sidebar a:hover {
            background: rgba(255,255,255,0.2);
        }

        /* CONTENT */
        .content {
            flex: 1;
            padding: 20px;
            background: #f5f5f5;
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>Admin</h2>

        <a href="/admin/dashboard">Dashboard</a>
        <a href="/admin/menu">Menu</a>
        <a href="/admin/order">Order</a>
        <a href="/admin/logout">Logout</a>
    </div>

    <!-- CONTENT -->
    <div class="content">
        @yield('content')
    </div>

</body>
</html>