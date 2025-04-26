<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Publisher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'published_books',
    ];

    protected $casts = [
        'published_books' => 'array',
    ];

    public function books()
    {
        return $this->hasMany(Book::class, 'publisher_id');
    }
}