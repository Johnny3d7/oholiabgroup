<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Livreur extends Model
{
    use HasFactory;
    use HasSlug;
    
    protected $table = 'livreurs';

    public $timestamps = true;

    protected $fillable = [
        'nom',
        'slug',
        'status'
    ];

    protected $guarded = ['id'];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nom')
            ->saveSlugsTo('slug');
    }

    public function livraisons()
    {
        return $this->hasMany(Livraison::class, 'id_livreur');
    }
}
