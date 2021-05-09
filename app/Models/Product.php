<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    public $incrementing = true;
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'name', 'description', 'image', 'price', 'category_id'
    ];

    protected $hidden = [];

    protected $casts = [
        'price' => 'float',
    ];

    public function get_image()
    {
        if(empty($this->image)) {
            return asset('pizza.png');
        }
        else {
            return asset('storage/' . $this->image);
        }
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function order_lines()
    {
        return $this->hasMany(OrderLine::class, 'product_id');
    }
}
