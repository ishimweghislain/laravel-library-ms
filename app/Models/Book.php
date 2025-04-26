<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'publication_date',
        'description',
        'available_copies',
        'publisher_id',
        'supplier_id',
        'borrowed_by',
    ];

    public function publisher()
    {
        return $this->belongsTo(Publisher::class, 'publisher_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function borrower()
    {
        return $this->belongsTo(User::class, 'borrowed_by');
    }

    public function borrowingTransactions()
    {
        return $this->hasMany(BorrowingTransaction::class, 'book_id');
    }
}