
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'NewsBharti Admin Panel')</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f4f6f9;
            font-family: Arial, sans-serif;
            color: #212529;
        }

        .admin-header {
            background: #212529;
            color: #fff;
            padding: 16px 24px;
        }

        .admin-header h4 {
            margin: 0;
            font-size: 22px;
            font-weight: 700;
        }

        .admin-wrapper {
            min-height: calc(100vh - 58px);
        }

        .admin-sidebar {
            background: #fff;
            min-height: calc(100vh - 58px);
            padding: 20px 12px;
            border-right: 1px solid #dee2e6;
        }

        .sidebar-heading {
            font-size: 12px;
            font-weight: 700;
            color: #6c757d;
            text-transform: uppercase;
            padding: 8px 12px;
            margin-bottom: 8px;
        }

        .admin-sidebar a {
            display: block;
            color: #343a40;
            text-decoration: none;
            padding: 11px 12px;
            margin-bottom: 5px;
            border-radius: 6px;
            transition: background 0.2s, color 0.2s;
        }

        .admin-sidebar a:hover {
            background: #e9f1ff;
            color: #0d6efd;
        }

        .admin-sidebar a.active {
            background: #0d6efd;
            color: #fff;
        }

        .main-content {
            padding: 28px;
            min-width: 0;
        }

        .card {
            border: 0;
            border-radius: 10px;
        }

        .alert {
            border-radius: 8px;
        }

        @media (max-width: 767px) {
            .admin-sidebar {
                min-height: auto;
                border-right: 0;
                border-bottom: 1px solid #dee2e6;
            }

            .main-content {
                padding: 18px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    <!-- Header -->
    <header class="admin-header">
        <h4>NewsBharti Admin Panel</h4>
    </header>

    <div class="container-fluid">
        <div class="row admin-wrapper">

            <!-- Sidebar -->
            <aside class="col-md-2 admin-sidebar">

                <div class="sidebar-heading">Main Menu</div>

                <a href="{{ route('admin.dashboard') }}"
                   class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>

                <a href="{{ route('admin.categories.index') }}"
                   class="{{ request()->routeIs('admin.categories.*') || request()->routeIs('admin.subcategories.*') ? 'active' : '' }}">
                    Categories
                </a>

               <a href="{{ route('admin.news.index') }}"
   class="{{ request()->routeIs('admin.news.index', 'admin.news.edit') ? 'active' : '' }}">
    All News
</a>

<a href="{{ route('admin.news.create') }}"
   class="{{ request()->routeIs('admin.news.create') ? 'active' : '' }}">
    Add New News
</a>

                <a href="#">
                    Homepage Sections
                </a>

                <a href="#">
                    SEO Settings
                </a>

            </aside>

            <!-- Main Content -->
            <main class="col-md-10 main-content">

                <!-- Success Message -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show"
                         role="alert">
                        {{ session('success') }}

                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="alert"
                                aria-label="Close"></button>
                    </div>
                @endif

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Page Content -->
                @yield('content')

            </main>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>
</html>
