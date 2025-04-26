<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Publisher;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['publisher', 'supplier', 'borrower'])->latest()->paginate(10);
        return view('books.index', compact('books'));
    }
    
    public function create()
    {
        $publishers = Publisher::all();
        $suppliers = Supplier::all();
        return view('books.create', compact('publishers', 'suppliers'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'publication_date' => 'required|date|before_or_equal:today',
            'description' => 'required|string',
            'available_copies' => 'required|integer|min:0',
            'publisher_id' => 'required|exists:publishers,id',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);
        
        $book = Book::create($validated);

        // Update supplier and publisher JSON arrays
        $supplier = Supplier::find($validated['supplier_id']);
        $suppliedBooks = $supplier->supplied_books ?? [];
        $suppliedBooks[] = $book->id;
        $supplier->update(['supplied_books' => $suppliedBooks]);

        $publisher = Publisher::find($validated['publisher_id']);
        $publishedBooks = $publisher->published_books ?? [];
        $publishedBooks[] = $book->id;
        $publisher->update(['published_books' => $publishedBooks]);

        return redirect()->route('books.index')->with('success', 'Book added successfully');
    }
    
    public function edit(Book $book)
    {
        $publishers = Publisher::all();
        $suppliers = Supplier::all();
        return view('books.edit', compact('book', 'publishers', 'suppliers'));
    }
    
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'publication_date' => 'required|date|before_or_equal:today',
            'description' => 'required|string',
            'available_copies' => 'required|integer|min:0',
            'publisher_id' => 'required|exists:publishers,id',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);
        
        $book->update($validated);
        return redirect()->route('books.index')->with('success', 'Book updated successfully');
    }
    
    public function destroy(Book $book)
    {
        try {
            DB::table('borrowing_transactions')->where('book_id', $book->id)->delete();
            $book->delete();
            return redirect()->route('books.index')->with('success', 'Book deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('books.index')->with('error', 'Failed to delete book: ' . $e->getMessage());
        }
    }
}