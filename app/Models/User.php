<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'gender',
        'district',
        'borrowed_books',
        'username',
        'password',
    ];

    protected $casts = [
        'borrowed_books' => 'array',
    ];

    public function books()
    {
        return $this->hasMany(Book::class, 'borrowed_by');
    }

    public function borrowingTransactions()
    {
        return $this->hasMany(BorrowingTransaction::class, 'user_id');
    }
}