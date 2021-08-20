<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class TypeProduct extends Model
{
    use HasFactory;

    use HasSlug;

    protected $table = 'type_products';

    protected $guarded = ['id'];

    public $timestamps = true;

    protected $fillable = [
        'lib',
        'slug',
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
        return $this->hasMany(Product::class, 'id_type_product');
    }
}
