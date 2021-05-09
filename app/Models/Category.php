<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    public $incrementing = true;
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    protected $hidden = [];

    protected $casts = [];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
