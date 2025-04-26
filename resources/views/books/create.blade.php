@extends('layouts.app')

@section('title', 'Add Book')

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
            <h2>Add New Book</h2>
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

        <form action="{{ route('books.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-input" value="{{ old('title') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Publication Date</label>
                <input type="date" name="publication_date" class="form-input" value="{{ old('publication_date') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-input" rows="4" required>{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Available Copies</label>
                <input type="number" name="available_copies" class="form-input" value="{{ old('available_copies') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Publisher</label>
                <select name="publisher_id" class="form-select" required>
                    @foreach($publishers as $publisher)
                        <option value="{{ $publisher->id }}" {{ old('publisher_id') == $publisher->id ? 'selected' : '' }}>{{ $publisher->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Supplier</label>
                <select name="supplier_id" class="form-select" required>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="button-group">
                <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Add Book</button>
            </div>
        </form>
    </div>
</div>
@endsection