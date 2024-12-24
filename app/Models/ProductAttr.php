<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttr extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function productAttributes(){
        return $this->hasMany(ProductAttribute::class ,'product_id', 'id');
    }
}
