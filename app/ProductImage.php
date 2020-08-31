<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_image';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'product_id', 'product_image_name'];
}
