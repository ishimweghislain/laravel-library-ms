<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\BorrowingTransaction;
use App\Models\Publisher;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // System totals
        $totalBooks = Book::count();
        $totalUsers = User::count();
        $totalTransactions = BorrowingTransaction::count();
        $totalPublishers = Publisher::count();
        $totalSuppliers = Supplier::count();

        // Weekly report: Transactions from the last 7 days
        $weeklyTransactions = BorrowingTransaction::with(['user', 'book'])
            ->where('borrow_date', '>=', now()->subDays(7))
            ->orderBy('borrow_date', 'desc')
            ->get();

        return view('dashboard', compact(
            'totalBooks',
            'totalUsers',
            'totalTransactions',
            'totalPublishers',
            'totalSuppliers',
            'weeklyTransactions'
        ));
    }
}