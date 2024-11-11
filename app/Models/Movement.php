<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity',
        'from_warehouse',
        'to_warehouse',
        'moved_by',
        'moved_at',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
