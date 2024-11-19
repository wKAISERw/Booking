<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    // Додаємо поле 'image' до масиву $fillable
    protected $fillable = ['name', 'address', 'capacity', 'image'];

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
