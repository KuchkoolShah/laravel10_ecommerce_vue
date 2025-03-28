<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryAttribute extends Model
{
    use HasFactory;
    protected $table = 'category_attribute';
    protected $guarded = [];



    public function attribute(){
        return $this->hasOne(Attribute::class, 'id' , 'attribute_id')->with('values');
    }
    public function values(){
        return $this->hasOne(AttributeValue::class, 'attribute_id' , 'attribute_id');
    }
    public function category(){
        return $this->hasOne(Category::class, 'id' , 'category_id');
    }
}
