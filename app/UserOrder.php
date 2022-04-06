<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{

    protected $table = 'tb_user_orders';

    protected $fillable = [
        'reference', 'pagseguro_status', 'pagseguro_code', 'store_id', 'items'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'tb_order_store', 'order_id');
    }
}
