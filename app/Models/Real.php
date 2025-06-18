<?php

namespace App\Models;

use App\Models\House;
use App\Models\Other;
use App\Models\Rating;
use App\Models\Review;
use App\Models\RealImage;
use App\Models\Commercial;
use App\Models\EstateTransaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Real extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function house()
    {
        return $this->hasOne(House::class);
    }
    public function other()
    {
        return $this->hasOne(Other::class);
    }
    public function commercial()
    {
        return $this->hasOne(Commercial::class);
    }
public function realImages(){
    return $this->hasMany(RealImage::class);
}
public function ratings()
{
    return $this->hasMany(Rating::class);
}

public function reviews()
{
    return $this->hasMany(Review::class);
}
public function transactions()
{
    return $this->hasMany(EstateTransaction::class, 'real_id');
}
public function wishlists()
{
    return $this->hasMany(Wishlist::class);
}

}
