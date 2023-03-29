<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Auction extends Model
{

    use HasFactory;


    protected $fillable = [
        'name', 'description', 'price', 'end_time', 'photo','user_id',
    ];

    protected $casts = [
        'end_time' =>  'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class)->orderBy('bid_amount', 'DESC');
    }
}


