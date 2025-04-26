<?php

namespace App\Http\Controllers;

use App\Models\BorrowingTransaction;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BorrowingTransactionController extends Controller
{
    public function index()
    {
        $transactions = BorrowingTransaction::with(['user', 'book'])->latest()->paginate(10);
        return view('borrowing_transactions.index', compact('transactions'));
    }
    
    public function create()
    {
        $users = User::all();
        $books = Book::whereNull('borrowed_by')->where('available_copies', '>', 0)->get();
        return view('borrowing_transactions.create', compact('users', 'books'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'borrow_date' => 'required|date|before_or_equal:today',
            'return_date' => 'nullable|date|after:borrow_date',
            'status' => 'required|in:borrowed,returned',
        ]);
        
        $book = Book::find($validated['book_id']);
        if ($book->borrowed_by || $book->available_copies <= 0) {
            return back()->withErrors(['book_id' => 'This book is not available for borrowing.']);
        }

        $transaction = BorrowingTransaction::create($validated);
        $book->update([
            'borrowed_by' => $validated['user_id'],
            'available_copies' => $book->available_copies - 1,
        ]);

        // Update user's borrowed_books JSON
        $user = User::find($validated['user_id']);
        $borrowedBooks = $user->borrowed_books ?? [];
        $borrowedBooks[] = [
            'bookId' => $validated['book_id'],
            'borrowDate' => $validated['borrow_date'],
            'returnDate' => $validated['return_date'],
        ];
        $user->update(['borrowed_books' => $borrowedBooks]);

        return redirect()->route('borrowing_transactions.index')->with('success', 'Transaction added successfully');
    }
    
    public function edit(BorrowingTransaction $borrowingTransaction)
    {
        $users = User::all();
        $books = Book::all();
        return view('borrowing_transactions.edit', compact('borrowingTransaction', 'users', 'books'));
    }
    
    public function update(Request $request, BorrowingTransaction $borrowingTransaction)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'borrow_date' => 'required|date|before_or_equal:today',
            'return_date' => 'nullable|date|after:borrow_date',
            'status' => 'required|in:borrowed,returned',
        ]);
        
        $borrowingTransaction->update($validated);
        return redirect()->route('borrowing_transactions.index')->with('success', 'Transaction updated successfully');
    }
    
    public function destroy(BorrowingTransaction $borrowingTransaction)
    {
        try {
            $borrowingTransaction->delete();
            return redirect()->route('borrowing_transactions.index')->with('success', 'Transaction deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('borrowing_transactions.index')->with('error', 'Failed to delete transaction: ' . $e->getMessage());
        }
    }
}