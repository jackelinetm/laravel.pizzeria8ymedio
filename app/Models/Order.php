<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    protected $table = 'orders';
    public $incrementing = true;
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'created_at', 'amount', 'status'
    ];

    protected $hidden = [];

    protected $casts = [
        'amount' => 'float',
        'created_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order_lines()
    {
        return $this->hasMany(OrderLine::class, 'order_id');
    }


    public const PENDING = 'Pending';
    public const APPROVED = 'Approved';

    public function status_badge()
    {
        if($this->status == static::PENDING) {
            return '<span class="badge badge-warning p-2 text-white">'. Str::upper($this->status) .'</span>';
        }
        else if($this->status == static::APPROVED) {
            return '<span class="badge badge-success p-2 text-white">'. Str::upper($this->status) .'</span>';
        }
        else { //not used actually
            return '<span class="badge badge-secondary p-2 text-white">'. Str::upper($this->status) .'</span>';
        }
    }
}
