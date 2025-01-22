<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = [];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function soldTickets()
    {
        return $this->hasMany(SoldTicket::class);
    }


    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }


    public function category() {
        return $this->belongsTo(Category::class);
    }
}
