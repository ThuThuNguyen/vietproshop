<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table="category";
    public $timestamps=false;
    public function prd()
    {
        return $this->hasMany('App\Models\Product', 'category_id', 'id');
    }
}
