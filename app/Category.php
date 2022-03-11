<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'tb_categories';

    protected $fillable = [
        'name', 'description', 'slug',
    ];

    public function produtcs()
    {
        return $this->belongsToMany(Product::class);
    }
}
