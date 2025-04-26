<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Library Management')</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .navbar {
            background-color: #333;
            padding: 10px;
        }
        .navbar a {
            color: white;
            margin: 0 15px;
            text-decoration: none;
        }
        .navbar a:hover {
            text-decoration: underline;
        }
        .content {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        @auth
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('books.index') }}">Books</a>
            <a href="{{ route('borrowing_transactions.index') }}">Transactions</a>
            <a href="{{ route('suppliers.index') }}">Suppliers</a>
            <a href="{{ route('publishers.index') }}">Publishers</a>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" style="background:none;border:none;color:white;cursor:pointer;">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @endauth
    </div>
    <div class="content">
        @yield('content')
    </div>
</body>
</html>