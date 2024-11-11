<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public function group()
    {
        return $this->belongsTo(ProductGroup::class);
    }

}
