@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<div class="container mx-auto px-4 py-8">
    <!-- Welcome Section -->
    <div class="bg-white shadow-lg rounded-lg p-6 mb-8 text-center">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Welcome to XYZ TSS Library</h1>
        <p class="text-gray-600 text-lg">Manage books, borrowing transactions, suppliers, and publishers from the navigation menu above.</p>
    </div>

    <!-- System Totals -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
        <div class="bg-blue-500 text-white rounded-lg shadow-md p-6 text-center">
            <h2 class="text-xl font-semibold">Total Books</h2>
            <p class="text-3xl mt-2">{{ $totalBooks }}</p>
        </div>
        <div class="bg-green-500 text-white rounded-lg shadow-md p-6 text-center">
            <h2 class="text-xl font-semibold">Total Users</h2>
            <p class="text-3xl mt-2">{{ $totalUsers }}</p>
        </div>
        <div class="bg-yellow-500 text-white rounded-lg shadow-md p-6 text-center">
            <h2 class="text-xl font-semibold">Total Transactions</h2>
            <p class="text-3xl mt-2">{{ $totalTransactions }}</p>
        </div>
        <div class="bg-purple-500 text-white rounded-lg shadow-md p-6 text-center">
            <h2 class="text-xl font-semibold">Total Publishers</h2>
            <p class="text-3xl mt-2">{{ $totalPublishers }}</p>
        </div>
        <div class="bg-red-500 text-white rounded-lg shadow-md p-6 text-center">
            <h merito="text-xl font-semibold">Total Suppliers</h2>
            <p class="text-3xl mt-2">{{ $totalSuppliers }}</p>
        </div>
    </div>

    <!-- Weekly Report -->
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Weekly Borrowing Report</h2>
        @if($weeklyTransactions->isEmpty())
            <p class="text-gray-600">No borrowing transactions in the past week.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="px-4 py-2">User</th>
                            <th class="px-4 py-2">Book</th>
                            <th class="px-4 py-2">Borrow Date</th>
                            <th class="px-4 py-2">Return Date</th>
                            <th class="px-4 py-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($weeklyTransactions as $transaction)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $transaction->user->name }}</td>
                                <td class="px-4 py-2">{{ $transaction->book->title }}</td>
                                <td class="px-4 py-2">{{ $transaction->borrow_date }}</td>
                                <td class="px-4 py-2">{{ $transaction->return_date ?? 'Not Returned' }}</td>
                                <td class="px-4 py-2">
                                    <span class="inline-block px-2 py-1 rounded {{ $transaction->status == 'borrowed' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                        {{ ucfirst($transaction->status) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection