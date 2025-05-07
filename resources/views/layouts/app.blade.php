<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Library Management')</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body>
    <div class="navbar">
        <div class="container navbar-content">
            <div class="logo">LibraryMS</div>
            <div class="nav-links">
                @auth
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                    <a href="{{ route('books.index') }}" class="{{ request()->routeIs('books.*') ? 'active' : '' }}">Books</a>
                    <a href="{{ route('borrowing_transactions.index') }}" class="{{ request()->routeIs('borrowing_transactions.*') ? 'active' : '' }}">Transactions</a>
                    <a href="{{ route('suppliers.index') }}" class="{{ request()->routeIs('suppliers.*') ? 'active' : '' }}">Suppliers</a>
                    <a href="{{ route('publishers.index') }}" class="{{ request()->routeIs('publishers.*') ? 'active' : '' }}">Publishers</a>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="logout-btn">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }}">Login</a>
                    <a href="{{ route('register') }}" class="{{ request()->routeIs('register') ? 'active' : '' }}">Register</a>
                @endauth
            </div>
        </div>
    </div>
    
    <div class="container content">
        @if(session('success'))
            <div id="notification" class="notification show">
                {{ session('success') }}
            </div>
        @endif
        
        @yield('content')
    </div>
    
    <div class="footer">
        <div class="container">
            &copy; {{ date('Y') }} Library Management System
        </div>
    </div>
    
    <script>
        // Simple notification system
        document.addEventListener('DOMContentLoaded', function() {
            const notification = document.getElementById('notification');
            if (notification) {
                setTimeout(function() {
                    notification.classList.remove('show');
                }, 5000);
            }
            
            // Add hover effect to navbar items
            const navLinks = document.querySelectorAll('.nav-links a');
            navLinks.forEach(link => {
                link.addEventListener('mouseover', function() {
                    this.style.transform = 'translateY(-2px)';
                });
                
                link.addEventListener('mouseout', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
            
            // Add smooth scroll effect
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
            
            // Add responsive navbar toggle
            window.addEventListener('scroll', function() {
                const navbar = document.querySelector('.navbar');
                if (window.scrollY > 50) {
                    navbar.style.boxShadow = '0 4px 12px rgba(0,0,0,0.1)';
                    navbar.style.padding = '5px 0';
                } else {
                    navbar.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
                    navbar.style.padding = '0';
                }
            });
        });
    </script>
</body>
</html>