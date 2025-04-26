@extends('layouts.app')

@section('title', 'Edit Borrowing Transaction')

@section('content')
<style>
    .container {
        width: 80%;
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
    }
    .form-card {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .card-header {
        border-bottom: 1px solid #ddd;
        margin-bottom: 20px;
        padding-bottom: 10px;
    }
    .form-group {
        margin-bottom: 15px;
    }
    .form-label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    .form-input, .form-select {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        margin-bottom: 10px;
    }
    .btn {
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        color: white;
    }
    .btn-primary {
        background-color: #007bff;
    }
    .btn-secondary {
        background-color: #6c757d;
    }
    .button-group {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }
    .error-message {
        background-color: #f8d7da;
        color: #721c24;
        padding: 12px;
        margin-bottom: 20px;
        border-radius: 4px;
    }
</style>

<div class="container">
    <div class="form-card">
        <div class="card-header">
            <h2>Edit Borrowing Transaction</h2>
        </div>

        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('borrowing_transactions.update', $borrowingTransaction->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label class="form-label">User</label>
                <select name="user_id" class="form-select" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id', $borrowingTransaction->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->role }})</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Book</label>
                <select name="book_id" class="form-select" required>
                    @foreach($books as $book)
                        <option value="{{ $book->id }}" {{ old('book_id', $borrowingTransaction->book_id) == $book->id ? 'selected' : '' }}>{{ $book->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Borrow Date</label>
                <input type="date" name="borrow_date" class="form-input" value="{{ old('borrow_date', $borrowingTransaction->borrow_date) }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Return Date</label>
                <input type="date" name="return_date" class="form-input" value="{{ old('return_date', $borrowingTransaction->return_date) }}">
            </div>

            <div class="form-group">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="borrowed" {{ old('status', $borrowingTransaction->status) == 'borrowed' ? 'selected' : '' }}>Borrowed</option>
                    <option value="returned" {{ old('status', $borrowingTransaction->status) == 'returned' ? 'selected' : '' }}>Returned</option>
                </select>
            </div>

            <div class="button-group">
                <a href="{{ route('borrowing_transactions.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Transaction</button>
            </div>
        </form>
    </div>
</div>
@endsection