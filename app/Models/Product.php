<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'company_id',
        'product_name',
        'price',
        'stock',
        'description',
        'img_path',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    /* いいねボタン */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /* いいねをしているか確認 */
    public function likedBy(User $user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

}