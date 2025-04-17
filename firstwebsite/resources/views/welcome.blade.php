<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <!-- ✅ Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<main class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 bg-dark text-white vh-100 sidebar p-3">
            <h5 class="text-white mb-4">Dashboard</h5>
            <ul class="nav flex-column">
                <!-- User Management -->
                <li class="nav-item">
                    <a class="nav-link text-white dropdown-toggle" data-bs-toggle="collapse" href="#userManagement" role="button" aria-expanded="false" aria-controls="userManagement">
                        👥 User Management
                    </a>
                    <div class="collapse" id="userManagement">
                        <ul class="nav flex-column ms-3">
                            <li><a href="{{ route('roles.index') }}" class="nav-link text-white"># Roles</a></li>
                            <li><a href="{{ route('users.index') }}" class="nav-link text-white">Users</a></li>
                        </ul>
                    </div>
                </li>

                <!-- Expense Category -->
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('expense_categories.index') }}">Expense Category</a>
                </li>

                <!-- Income Category -->
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('income_categories.index') }}">Income Category</a>
                </li>

                <!-- Expenses -->
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('expenses.index') }}">Expenses</a>
                </li>

                <!-- Income -->
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('income.index') }}">Income</a>
                </li>

                <!-- Monthly Report -->
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('reports.monthly') }}">Monthly Report</a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 p-4 bg-light">
            @yield('content')
        </div>
    </div>
</main>

<!-- ✅ Bootstrap Bundle JS (includes Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
