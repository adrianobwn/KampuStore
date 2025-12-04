<nav class="fixed top-0 left-0 right-0 z-50 bg-white/95 dark:bg-gray-900/95 backdrop-blur-md border-b border-gray-200 dark:border-gray-800 transition-colors duration-300">
    <div class="container mx-auto px-6">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center space-x-8">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg">
                        <i class="uil uil-store text-white text-xl"></i>
                    </div>
                    <span class="text-xl font-bold text-gray-900 dark:text-white">kampuStore</span>
                </a>

                <!-- Main Menu -->
                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ route('home') }}" class="px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-orange-600 dark:hover:text-orange-400 font-medium transition-colors rounded-lg hover:bg-orange-50 dark:hover:bg-orange-900/20">Home</a>
                    <a href="{{ route('home') }}#features" class="px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-orange-600 dark:hover:text-orange-400 font-medium transition-colors rounded-lg hover:bg-orange-50 dark:hover:bg-orange-900/20">Features</a>
                    <a href="{{ route('products.index') }}" class="px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-orange-600 dark:hover:text-orange-400 font-medium transition-colors rounded-lg hover:bg-orange-50 dark:hover:bg-orange-900/20">Market</a>
                    <a href="{{ route('home') }}#about" class="px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-orange-600 dark:hover:text-orange-400 font-medium transition-colors rounded-lg hover:bg-orange-50 dark:hover:bg-orange-900/20">About</a>
                    <a href="{{ route('home') }}#contact" class="px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-orange-600 dark:hover:text-orange-400 font-medium transition-colors rounded-lg hover:bg-orange-50 dark:hover:bg-orange-900/20">Contact</a>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center space-x-3">
                <!-- Theme Toggle -->
                <button id="theme-toggle" class="p-2.5 rounded-lg bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-all hover:scale-105 shadow-sm">
                    <i class="uil uil-moon text-gray-600 dark:text-yellow-400 text-lg"></i>
                </button>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="flex items-center space-x-2 px-4 py-2.5 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white rounded-lg transition-all shadow-md hover:shadow-lg hover:scale-105">
                        <i class="uil uil-sign-out-alt"></i>
                        <span class="font-medium">Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<script>
    // Theme Toggle with improved UX
    document.addEventListener('DOMContentLoaded', function() {
        const themeToggle = document.getElementById('theme-toggle');
        const html = document.documentElement;

        // Check for saved theme preference or default to light
        const savedTheme = localStorage.getItem('theme') || 'light';
        
        // Apply saved theme immediately
        if (savedTheme === 'dark') {
            html.classList.add('dark');
            themeToggle.innerHTML = '<i class="uil uil-sun text-yellow-400 dark:text-yellow-400 text-lg"></i>';
        } else {
            html.classList.remove('dark');
            themeToggle.innerHTML = '<i class="uil uil-moon text-gray-600 dark:text-yellow-400 text-lg"></i>';
        }

        // Toggle theme on button click
        themeToggle.addEventListener('click', () => {
            html.classList.toggle('dark');
            const isDark = html.classList.contains('dark');
            
            // Save preference
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            
            // Update icon with smooth transition
            themeToggle.style.transform = 'rotate(360deg)';
            setTimeout(() => {
                themeToggle.style.transform = 'rotate(0deg)';
            }, 300);
            
            themeToggle.innerHTML = isDark ?
                '<i class="uil uil-sun text-yellow-400 dark:text-yellow-400 text-lg"></i>' :
                '<i class="uil uil-moon text-gray-600 dark:text-yellow-400 text-lg"></i>';
        });

        // Add smooth transition to toggle button
        themeToggle.style.transition = 'transform 0.3s ease';
    });
</script>