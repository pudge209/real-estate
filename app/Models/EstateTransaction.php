<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstateTransaction extends Model
{
    protected $guarded = [];

    public function real()
    {
        return $this->belongsTo(Real::class, 'real_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
