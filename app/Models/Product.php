<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // ← 追加

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
       'user_id',
       'name',
       'price',
       'description',
       'stock',
       'image',
    ];

    /**
     * 出品ユーザーとのリレーション
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}