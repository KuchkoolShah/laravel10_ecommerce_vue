<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function productValues(){
        return $this->hasMany(Product::class ,'id', 'product_id');
    }
    public function images(){
        return $this->hasMany(Product::class ,'id', 'product_id');
    }
}
