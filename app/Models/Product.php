<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function getCategory(){
        return $this->hasOne(Category::class,'id','category');
    }

    public function getModels(){
        return $this->hasMany(ProductModel::class,'productId','id');
    }

    public function getGalleries(){
        return $this->hasMany(ProductGallery::class,'productId','id');
    }

    public function getColors(){
        return $this->hasMany(ProductColor::class,'productId','id');
    }
}
