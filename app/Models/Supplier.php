<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'supplied_books',
    ];

    protected $casts = [
        'supplied_books' => 'array',
    ];

    public function books()
    {
        return $this->hasMany(Book::class, 'supplier_id');
    }
}