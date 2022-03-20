<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    use HasFactory;

    protected $table = 'stock_movement';

    protected $fillable = [
        'product_id',
        'movements',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /**
     * setting array type for movement field
     */
    protected $casts = [
        'movements' => 'array'
    ];
}
