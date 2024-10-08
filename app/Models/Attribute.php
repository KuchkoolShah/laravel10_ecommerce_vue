<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function values(){
        return $this->hasOne(AttributeValue::class, 'attribute_id' , 'id');
    }
}
