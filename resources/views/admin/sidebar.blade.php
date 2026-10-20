<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'NewsBharti Admin Panel')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        :root {
            --brand-red: #ed101b;
            --brand-blue: #1239c5;
            --brand-dark: #15213b;
            --page-bg: #f4f6fa;
            --border-color: #e5e8ef;
            --header-height: 70px;
            --sidebar-width: 240px;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            height: 100%;
            margin: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: var(--page-bg);
            color: #252b38;
            overflow: hidden;
        }

        /* Fixed top header */
        .admin-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1050;
            height: var(--header-height);
            padding: 0 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            background: #fff;
            border-bottom: 3px solid var(--brand-red);
        }

        .brand-name {
            display: flex;
            align-items: center;
            gap: 11px;
            min-width: 0;
            font-size: 21px;
            font-weight: 800;
            color: var(--brand-dark);
            text-decoration: none;
        }

        .brand-mark {
            width: 39px;
            height: 39px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 7px;
            background: var(--brand-red);
            color: #fff;
            font-size: 17px;
            font-weight: 800;
        }

        .brand-bharti {
            color: var(--brand-blue);
        }

        .header-label {
            flex-shrink: 0;
            font-size: 11px;
            font-weight: 700;
            color: var(--brand-blue);
            background: #edf1ff;
            border: 1px solid #dce4ff;
            border-radius: 5px;
            padding: 7px 11px;
        }

        /* Fixed sidebar */
        .admin-sidebar {
            position: fixed;
            top: var(--header-height);
            bottom: 0;
            left: 0;
            z-index: 1000;
            width: var(--sidebar-width);
            padding: 22px 13px;
            background: #fff;
            border-right: 1px solid var(--border-color);
            overflow-y: auto;
            overflow-x: hidden;
        }

        .sidebar-heading {
            padding: 8px 12px 13px;
            font-size: 11px;
            font-weight: 800;
            color: #8a91a0;
            text-transform: uppercase;
            letter-spacing: .8px;
        }

        .admin-sidebar a {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 12px;
            margin-bottom: 6px;
            color: #51596a;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            border-radius: 6px;
            transition: background .2s, color .2s;
        }

        .menu-dot {
            width: 8px;
            height: 8px;
            flex-shrink: 0;
            border: 2px solid #a5adbd;
            border-radius: 3px;
        }

        .admin-sidebar a:hover {
            background: #fff0f1;
            color: var(--brand-red);
        }

        .admin-sidebar a:hover .menu-dot {
            border-color: var(--brand-red);
        }

        .admin-sidebar a.active {
            color: #fff;
            background: var(--brand-blue);
        }

        .admin-sidebar a.active .menu-dot {
            background: #fff;
            border-color: #fff;
        }

        .sidebar-footer {
            margin: 25px 5px 0;
            padding: 14px 9px;
            border-top: 1px solid var(--border-color);
            color: #858c9a;
            font-size: 11px;
            line-height: 1.7;
        }

        /* Only this area scrolls */
        .main-content {
            position: fixed;
            top: var(--header-height);
            right: 0;
            bottom: 0;
            left: var(--sidebar-width);
            width: auto;
            min-width: 0;
            padding: 25px;
            overflow-y: auto;
            overflow-x: hidden;
            background: var(--page-bg);
            overscroll-behavior: contain;
        }

        .main-content > * {
            max-width: 100%;
        }

        .card {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(23, 37, 66, .04);
        }

        .alert {
            border-radius: 7px;
        }

        .btn-primary {
            background: var(--brand-blue);
            border-color: var(--brand-blue);
        }

        .btn-primary:hover {
            background: #092a9f;
            border-color: #092a9f;
        }

        /* Scrollbar */
        .main-content::-webkit-scrollbar,
        .admin-sidebar::-webkit-scrollbar {
            width: 7px;
        }

        .main-content::-webkit-scrollbar-thumb,
        .admin-sidebar::-webkit-scrollbar-thumb {
            background: #cbd1df;
            border-radius: 10px;
        }

        .main-content::-webkit-scrollbar-thumb:hover,
        .admin-sidebar::-webkit-scrollbar-thumb:hover {
            background: #9da7bb;
        }

        /* Tablet and mobile */
        @media (max-width: 767px) {
            :root {
                --header-height: 62px;
                --sidebar-width: 185px;
            }

            .admin-header {
                padding: 0 13px;
            }

            .brand-name {
                font-size: 16px;
                gap: 8px;
            }

            .brand-mark {
                width: 32px;
                height: 32px;
                font-size: 14px;
            }

            .header-label {
                font-size: 9px;
                padding: 6px 7px;
            }

            .admin-sidebar {
                padding: 15px 9px;
            }

            .admin-sidebar a {
                padding: 10px 8px;
                gap: 8px;
                font-size: 12px;
            }

            .sidebar-heading {
                padding-left: 8px;
                font-size: 10px;
            }

            .main-content {
                padding: 17px 13px;
            }

            .sidebar-footer {
                font-size: 10px;
            }
        }

        /* Small mobile */
        @media (max-width: 480px) {
            :root {
                --sidebar-width: 135px;
            }

            .brand-name {
                font-size: 14px;
            }

            .brand-mark {
                width: 29px;
                height: 29px;
                font-size: 12px;
            }

            .header-label {
                font-size: 8px;
                padding: 5px;
            }

            .admin-sidebar {
                padding: 12px 6px;
            }

            .admin-sidebar a {
                padding: 10px 6px;
                gap: 6px;
                font-size: 11px;
            }

            .menu-dot {
                width: 7px;
                height: 7px;
            }

            .main-content {
                padding: 13px 9px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    {{-- Fixed Header --}}
    <header class="admin-header">
        <a href="{{ route('admin.dashboard') }}" class="brand-name">
            <span class="brand-mark">SB</span>
            <span>Samachar <span class="brand-bharti">Bharti</span></span>
        </a>

        <span class="header-label">ADMIN PANEL</span>
    </header>

    {{-- Fixed Sidebar --}}
    <aside class="admin-sidebar">

        <div class="sidebar-heading">Main Menu</div>

        <a href="{{ route('admin.dashboard') }}"
           class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="menu-dot"></span>
            Dashboard
        </a>

        <a href="{{ route('admin.categories.index') }}"
           class="{{ request()->routeIs('admin.categories.*', 'admin.subcategories.*') ? 'active' : '' }}">
            <span class="menu-dot"></span>
            Categories
        </a>

        <a href="{{ route('admin.news.index') }}"
           class="{{ request()->routeIs('admin.news.index', 'admin.news.edit') ? 'active' : '' }}">
            <span class="menu-dot"></span>
            All News
        </a>

        <a href="{{ route('admin.news.create') }}"
           class="{{ request()->routeIs('admin.news.create') ? 'active' : '' }}">
            <span class="menu-dot"></span>
            Add New News
        </a>

        <div class="sidebar-footer">
            <strong>Samachar Bharti</strong><br>
            News Management System
        </div>

    </aside>

    {{-- Scrollable Main Content --}}
    <main class="main-content">

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

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>
</html>
