<?php

namespace App\Models;

use App\Models\Real;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Other extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function real()
    {
        return $this->belongsTo(Real::class);
    }
}
