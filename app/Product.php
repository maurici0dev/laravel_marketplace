<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{

    use HasSlug;

    protected $table = 'tb_products';

    protected $fillable = [
        'name', 'description', 'body', 'price', 'slug',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'tb_category_product');
    }

    public function photos()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function getThumbAttribute()
    {
        return $this->photos->first()->image;
    }
}
