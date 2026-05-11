<?php

namespace App\Models;
use App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
