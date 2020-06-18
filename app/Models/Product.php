<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table="product";
    public function category()
    {
        return $this->belongsTo('App\models\Category', 'category_id', 'id');
    }
    
}
