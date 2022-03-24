<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
{

    use HasSlug;

    protected $table = 'tb_categories';

    protected $fillable = [
        'name', 'description', 'slug',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function produtcs()
    {
        return $this->belongsToMany(Product::class);
    }
}
