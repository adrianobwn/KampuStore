<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin' }} | kampuStore</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        /* Custom Variables and Dark Mode */
        :root {
            --primary: #f97316;
            --primary-dark: #ea580c;
            --success: #22c55e;
            --warning: #eab308;
            --danger: #ef4444;
            --info: #3b82f6;
            --dark: #1f2937;
            --light: #f8fafc;
            --text-primary: #111827;
            --text-secondary: #6b7280;
            --border: #e5e7eb;
            --shadow: 0 1px 3px rgba(0,0,0,0.12);
            --shadow-lg: 0 10px 15px rgba(0,0,0,0.1);
        }

        /* Dark mode variables */
        .dark {
            --bg-primary: #0f172a;
            --bg-secondary: #1e293b;
            --bg-card: #1f2937;
            --text-primary: #f1f5f9;
            --text-secondary: #9ca3af;
            --border: #374151;
            --card-hover: #374151;
        }

        /* Base styles */
        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
        }
        
        body {
            background: linear-gradient(135deg, #f8fafc 0%, #e0e7ff 100%);
            font-size: 14px;
            line-height: 1.6;
            color: #111827;
            font-weight: 400;
            transition: background 0.3s ease, color 0.3s ease;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        html.dark body {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: #f1f5f9;
        }

        /* Glass effect for modern UI */
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        html.dark .glass-effect {
            background: rgba(31, 41, 55, 0.95);
            border-color: rgba(55, 65, 81, 0.5);
        }

        /* Card styles */
        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
            color: #111827;
        }

        html.dark .card {
            background: #1f2937;
            border-color: #374151;
            color: #f1f5f9;
        }

        .card:hover {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        html.dark .card:hover {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        /* Button styles */
        .btn {
            display: inline-flex;
            align-items: center;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-family: inherit;
            color: white;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        .btn-success {
            background: var(--success);
            color: white;
        }

        .btn-danger {
            background: var(--danger);
            color: white;
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
        }

        .btn-secondary:hover {
            background: #4b5563;
        }

        /* Status badges */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-success {
            background: #dcfce7;
            color: #166534;
        }

        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge-info {
            background: #dbeafe;
            color: #1e40af;
        }

        html.dark .badge-success {
            background: rgba(34, 197, 94, 0.2);
            color: #86efac;
        }

        html.dark .badge-warning {
            background: rgba(234, 179, 8, 0.2);
            color: #fde047;
        }

        html.dark .badge-danger {
            background: rgba(239, 68, 68, 0.2);
            color: #fca5a5;
        }

        html.dark .badge-info {
            background: rgba(59, 130, 246, 0.2);
            color: #93c5fd;
        }

        /* Form inputs */
        .form-input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.2s ease;
            background: white;
            color: #111827;
        }

        html.dark .form-input {
            background: #374151;
            border-color: #4b5563;
            color: #f9fafb;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 4px;
        }

        html.dark .form-label {
            color: #d1d5db;
        }

        /* Navigation styles */
        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: #374151;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.2s ease;
            font-size: 14px;
            font-weight: 500;
        }

        html.dark .nav-link {
            color: #9ca3af;
        }

        .nav-link:hover {
            background: #f3f4f6;
            color: var(--primary);
        }

        html.dark .nav-link:hover {
            background: #374151;
            color: var(--primary);
        }

        .nav-link.active {
            background: #fff7ed;
            color: var(--primary);
            font-weight: 600;
        }

        html.dark .nav-link.active {
            background: #431407;
            color: var(--primary);
        }

        /* Sidebar styles */
        .sidebar {
            background: white;
            border-right: 1px solid #e5e7eb;
        }

        html.dark .sidebar {
            background: #1f2937;
            border-color: #374151;
        }

        /* Table styles */
        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 12px 16px;
            font-size: 12px;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
        }

        html.dark th {
            color: #9ca3af;
            background: #374151;
            border-color: #4b5563;
        }

        td {
            padding: 12px 16px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
            color: #111827;
            font-weight: 400;
        }

        html.dark td {
            border-color: #374151;
            color: #f9fafb;
        }

        tr:hover td {
            background: #f9fafb;
        }

        html.dark tr:hover td {
            background: #374151;
        }

        /* Responsive utilities */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: 0;
                top: 0;
                height: 100%;
                width: 256px;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                z-index: 50;
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }
        }

        /* Navigation bar */
        .navbar {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 40;
        }

        htmlhtml.dark .navbar {
            background: #1f2937;
            border-color: #374151;
        }

        /* Theme toggle */
        .theme-toggle {
            position: relative;
            width: 60px;
            height: 30px;
            background: #374151;
            border-radius: 15px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .theme-toggle-slider {
            position: absolute;
            top: 3px;
            left: 3px;
            width: 24px;
            height: 24px;
            background: white;
            border-radius: 50%;
            transition: transform 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .dark .theme-toggle {
            background: #fbbf24;
        }

        .dark .theme-toggle-slider {
            transform: translateX(30px);
        }

        /* Animation utilities */
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        .slide-up {
            animation: slideUp 0.6s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Text visibility improvements */
        h1, h2, h3, h4, h5, h6 {
            font-weight: 600;
            color: #111827;
        }

        html.dark h1, .dark h2, .dark h3, .dark h4, .dark h5, .dark h6 {
            color: #f1f5f9;
        }

        p, span, div {
            color: inherit;
        }

        /* Ensure all text is visible */
        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif !important;
        }

        /* Print styles */
        @media print {
            .no-print {
                display: none !important;
            }

            .card {
                box-shadow: none !important;
                border: 1px solid #000 !important;
            }
        }
    </style>
</head>
<body class="{{ (isset($_COOKIE['theme']) && $_COOKIE['theme'] === 'dark') ? 'dark' : '' }}">
    <!-- Navigation Bar -->
    <nav class="navbar no-print">
        <div class="container mx-auto px-6">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                        <div class="w-10 h-10 bg-orange-500 rounded-lg flex items-center justify-center group-hover:bg-orange-600 transition-colors">
                            <i class="uil uil-store text-white text-xl"></i>
                        </div>
                        <span class="text-xl font-bold text-gray-900 dark:text-white">kampuStore</span>
                    </a>

                    <!-- Main Menu -->
                    <div class="hidden md:flex items-center space-x-6">
                        <a href="{{ route('home') }}" class="text-gray-600 dark:text-gray-300 hover:text-orange-600 font-medium transition-colors">Home</a>
                        <a href="{{ route('home') }}#features" class="text-gray-600 dark:text-gray-300 hover:text-orange-600 font-medium transition-colors">Features</a>
                        <a href="{{ route('products.index') }}" class="text-gray-600 dark:text-gray-300 hover:text-orange-600 font-medium transition-colors">Market</a>
                        <a href="{{ route('home') }}#about" class="text-gray-600 dark:text-gray-300 hover:text-orange-600 font-medium transition-colors">About</a>
                        <a href="{{ route('home') }}#contact" class="text-gray-600 dark:text-gray-300 hover:text-orange-600 font-medium transition-colors">Contact</a>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center space-x-4">
                    <!-- Theme Toggle -->
                    <div class="theme-toggle" onclick="toggleTheme()">
                        <div class="theme-toggle-slider">
                            <i class="uil {{ (isset($_COOKIE['theme']) && $_COOKIE['theme'] === 'dark') ? 'uil-moon' : 'uil-sun' }} text-xs" id="theme-icon"></i>
                        </div>
                    </div>

                    <!-- User Profile -->
                    <div class="flex items-center space-x-3">
                        <div class="text-right">
                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ auth()->user()->name }}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Administrator</div>
                        </div>
                        <div class="w-10 h-10 bg-orange-100 dark:bg-orange-900 rounded-lg flex items-center justify-center">
                            <i class="uil uil-user text-orange-600 dark:text-orange-400 text-xl"></i>
                        </div>
                    </div>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="flex items-center space-x-2 px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors">
                            <i class="uil uil-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Layout -->
    <div class="flex min-h-screen pt-16">
        <!-- Sidebar -->
        <aside class="w-64 sidebar min-h-screen no-print">
            <div class="p-6 space-y-8">
                <!-- Admin Profile -->
                <div class="text-center">
                    <div class="w-20 h-20 bg-orange-100 dark:bg-orange-900 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="uil uil-user text-orange-600 dark:text-orange-400 text-2xl"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white">{{ auth()->user()->name }}</h3>
                    <div class="inline-flex items-center space-x-1 px-3 py-1 bg-orange-100 dark:bg-orange-900 text-orange-600 dark:text-orange-400 rounded-full text-sm font-medium mt-2">
                        <i class="uil uil-shield-check text-xs"></i>
                        <span>Administrator</span>
                    </div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">{{ auth()->user()->email }}</p>
                </div>

                <!-- Navigation Menu -->
                <nav class="space-y-6">
                    <!-- Dashboard -->
                    <div>
                        <h4 class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-3">Dashboard</h4>
                        <div class="space-y-1">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                <i class="uil uil-dashboard text-lg"></i>
                                <span>Dashboard</span>
                            </a>
                        </div>
                    </div>

                    <!-- Store Management -->
                    <div>
                        <h4 class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-3">Manajemen Toko</h4>
                        <div class="space-y-1">
                            <a href="{{ route('admin.sellers.index') }}" class="nav-link {{ request()->routeIs('admin.sellers*') ? 'active' : '' }}">
                                <i class="uil uil-folder text-lg"></i>
                                <span>Pengajuan Toko</span>
                            </a>
                            <a href="{{ route('admin.reports.sellers') }}" class="nav-link {{ request()->routeIs('admin.reports.sellers') ? 'active' : '' }}">
                                <i class="uil uil-file-alt text-lg"></i>
                                <span>Laporan Toko</span>
                            </a>
                            <a href="{{ route('admin.reports.sellers-location') }}" class="nav-link {{ request()->routeIs('admin.reports.sellers-location') ? 'active' : '' }}">
                                <i class="uil uil-map-marker text-lg"></i>
                                <span>Toko per Lokasi</span>
                            </a>
                        </div>
                    </div>

                    <!-- Product Reports -->
                    <div>
                        <h4 class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-3">Laporan Produk</h4>
                        <div class="space-y-1">
                            <a href="{{ route('admin.reports.product-ranking') }}" class="nav-link {{ request()->routeIs('admin.reports.product-ranking') ? 'active' : '' }}">
                                <i class="uil uil-star text-lg"></i>
                                <span>Rating Produk</span>
                            </a>
                        </div>
                    </div>

                    <!-- Settings -->
                    <div>
                        <h4 class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-3">Pengaturan</h4>
                        <div class="space-y-1">
                            <a href="{{ route('admin.sellers.index') }}" class="nav-link {{ request()->routeIs('admin.sellers*') ? 'active' : '' }}">
                                <i class="uil uil-users text-lg"></i>
                                <span>Verifikasi Penjual</span>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 main-content">
            @yield('content')
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 py-6 mt-auto no-print">
        <div class="container mx-auto px-6 text-center">
            <p class="text-gray-600 dark:text-gray-400">&copy; {{ date('Y') }} <span class="font-semibold text-orange-600">kampuStore</span>. All rights reserved.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#f97316'
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#f97316'
            });
        </script>
    @endif

    <script>
        // Theme toggle functionality
        function toggleTheme() {
            const body = document.body;
            const icon = document.getElementById('theme-icon');

            if (body.classList.contains('dark')) {
                body.classList.remove('dark');
                icon.className = 'uil uil-sun text-xs';
                document.cookie = 'theme=light; max-age=31536000; path=/';
            } else {
                body.classList.add('dark');
                icon.className = 'uil uil-moon text-xs';
                document.cookie = 'theme=dark; max-age=31536000; path=/';
            }
        }

        // Initialize theme on page load
        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = getCookie('theme');
            if (savedTheme === 'dark') {
                document.body.classList.add('dark');
            }
        });

        // Cookie helper function
        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
            return null;
        }
    </script>

    @yield('scripts')
</body>
</html>