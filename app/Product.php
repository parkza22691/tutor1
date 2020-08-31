<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $table = 'product';
  protected $primaryKey = 'product_id';
  protected $fillable = ['product_id', 'product_name', 'product_price', 'product_image', 'list_order'];
}
