<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function singleAttribute(){
        return $this->hasOne(Attribute::class, 'id' , 'attribute_id');
    }
    public function categoryAttribute(){
        return $this->belongsTo(CategoryAttribute::class, 'id' , 'attribute_id');
    }
}
