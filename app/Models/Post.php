<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
     use HasFactory;

    // 👇 This allows mass-assignment of these fields
    protected $fillable = ['title', 'content'];

    // 👇 This defines the relationship: each post belongs to one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
