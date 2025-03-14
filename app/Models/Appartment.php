<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'surface',
        'price',
        'piece',
        'bedroom',
        'floor',
        'address',
        'city',
        'postal_code',
        'is_sell',
    ];

    public function options()
    {
        return $this->belongsToMany(Options::class);
    }

    public function images()
    {
        return $this->belongsToMany(Image::class);
    }
}
