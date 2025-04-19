<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Income And Expenditure System</title>

    <!-- ✅ Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <main class="container-fluid">
        <div class="row">

            @auth
                <!-- Sidebar (only for authenticated users) -->
                <div class="col-md-3 col-lg-2 bg-dark text-white vh-100 sidebar p-3">
                    <h4 class="text-white fw-bold mb-4">EXPENSE TRACKER</h4>
                    <ul class="nav flex-column">
                        <!-- User Management -->
                        <li class="nav-item mb-2">
                            <a class="nav-link text-white d-flex justify-content-between align-items-center"
                                data-bs-toggle="collapse" href="#userManagement" role="button" aria-expanded="false"
                                aria-controls="userManagement">
                                <span>👥 User Management</span>
                                <span class="ms-2">&#9662;</span>
                            </a>
                            <div class="collapse" id="userManagement">
                                <ul class="nav flex-column ms-3 mt-1">
                                    <li>
                                        <a href="{{ route('permissions.index') }}" class="nav-link text-white">🔑 Permissions</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('roles.index') }}" class="nav-link text-white">🔐 Roles</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('users.index') }}" class="nav-link text-white">🙋 Users</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('expense_categories.index') }}" class="nav-link text-white">📂 Expense Category</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('income_categories.index') }}" class="nav-link text-white">💼 Income Category</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('expenses.index') }}" class="nav-link text-white">💸 Expenses</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('income.index') }}" class="nav-link text-white">📥 Income</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reports.monthly') }}" class="nav-link text-white">📊 Monthly Report</a>
                        </li>

                        <!-- ✅ Logout Button -->
                        <li class="nav-item mt-3">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-danger w-100">🚪 Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth

            <!-- Main content (always visible) -->
            <div class="@auth col-md-9 col-lg-10 @else col-12 @endauth p-4 bg-light">
                @yield('content')
            </div>

        </div>
    </main>

    <!-- ✅ Bootstrap Bundle JS (includes Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- ✅ Include any scripts pushed from other views (e.g., DataTables) -->
    @stack('scripts')

</body>
</html>
