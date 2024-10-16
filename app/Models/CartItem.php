<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class CartItem extends Model
{
    protected $fillable = ['ticket_id', 'quantity'];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
