<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'real_id', 'rating'];

    public function real()
    {
        return $this->belongsTo(Real::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Review.php


}
