<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Bill extends Model
{
    use HasFactory;

    protected $fillable=[
        'date',
        'total_price',

    ];



    public function drugs(): BelongsToMany
    {
        return $this->belongsToMany(Drug::class)->withPivot('quantity');
    }

}
