<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\True_;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'company',
        'phone_number',
        'email',
        'loans',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
