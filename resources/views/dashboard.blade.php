@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<style>
    .container {
        width: 90%;
        margin: 20px auto;
        padding: 20px;
    }
    .welcome-card {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        text-align: center;
    }
    .welcome-card h1 {
        color: #2c3e50;
        margin-bottom: 1rem;
    }
    .welcome-card p {
        color: #34495e;
        font-size: 1.1rem;
    }
</style>

<div class="container">
    <div class="welcome-card">
        <h1>Welcome to XYZ TSS Library</h1>
        <p>Manage books, borrowing transactions, suppliers, and publishers from the navigation menu above.</p>
    </div>
</div>
@endsection