<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StockMovement;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'nome',
        'SKU',
        'quantidade'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function movements()
    {
      return $this->hasOne(StockMovement::class, 'product_id', 'id');
    }
}
