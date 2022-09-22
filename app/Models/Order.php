<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable=[
        'supplier_id',
        'supplier_name',

        'date',
        'total_price',
        'paid',
        'remaining',
    ];

    public function drugs(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Drug::class)->withPivot('quantity');
    }


    public function suppliers()
    {
        return $this->belongsTo(Supplier::class);
    }
}
