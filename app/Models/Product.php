<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use URL;
class Product extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function attribute(){
        return $this->hasMany(ProductAttribute::class ,'product_id', 'id')->with('product_values');
    }
    public function value(){
        return $this->hasMany(ProductAttribute::class ,'product_id', 'id')->with('product_values');
    }
    public function productAttributes(){
        return $this->hasMany(ProductAttr::class ,'product_id', 'id');
    }
    protected function Image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => URL::to(''.$value.'')
        );
    }
}

