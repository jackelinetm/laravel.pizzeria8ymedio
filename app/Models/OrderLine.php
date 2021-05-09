<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    protected $table = 'order_lines';
    public $incrementing = true;
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'order_id', 'product_id', 'quantity', 'price', 'amount'
    ];

    protected $hidden = [];

    protected $casts = [
        'price' => 'float',
        'amount' => 'float',
        'quantity' => 'int',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }


}
