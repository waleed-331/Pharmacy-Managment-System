<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'company',
        'body_system',
        'price',
        'expiration_date',
        'place',
        'quantity',
        'form',
        'dose',
        'price_for_public',
        'prescription',
        'scientific_name'
    ];


    public function orders(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Order::class)->withpivot('quantity');
    }

    public function bills(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Bill::class)->withpivot('quantity');
    }


}
