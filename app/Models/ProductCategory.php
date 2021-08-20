<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
class ProductCategory extends Model
{
    use HasFactory;

    use HasSlug;

    protected $table = 'products_categories';

    protected $guarded = ['id'];

    public $timestamps = true;

    protected $fillable = [
        'lib',
        'slug',
        'commercialisable',
        'status'
    ];

    
    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('lib')
            ->saveSlugsTo('slug');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'id_product_category');
    }
}


