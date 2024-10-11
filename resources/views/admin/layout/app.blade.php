<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | Admin Panel</title>
    <!-- Font & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Styles -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background-color: #f4f4f4;
        }
        .admin-layout {
            display: flex;
            height: 100vh;
        }
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            padding: 20px;
            color: white;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            margin: 15px 0;
            font-size: 1rem;
        }
        .sidebar a:hover {
            background-color: #34495e;
            padding: 10px;
        }
        .header {
            background-color: #3498db;
            padding: 15px;
            color: white;
            text-align: right;
        }
        .header .logout {
            text-decoration: none;
            color: white;
        }
        .content {
            width: 100%;
            padding: 20px;
        }
        .content h1 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="admin-layout">
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
        <a href="#"><i class="fas fa-users"></i> Manage Users</a>
        <a href="#"><i class="fas fa-box"></i> Manage Products</a>
        <a href="#"><i class="fas fa-chart-line"></i> Reports</a>
        <a href="#"><i class="fas fa-cogs"></i> Settings</a>
        <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <!-- Content Area -->
    <div class="content">
        <div class="header">
            <a href="#" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>

        <!-- Page Content -->
        @yield('content')
    </div>
</div>

</body>
</html>
