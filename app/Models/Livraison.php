<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Livraison extends Model
{
    use HasFactory;
    use HasSlug;

    protected $table = 'livraisons';

    public $timestamps = true;

    protected $fillable = [
        'nom_livreur',
        'num_vehicule',
        'date_reception',
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
            ->generateSlugsFrom('lib')
            ->saveSlugsTo('slug');
    }

    public function commande()
    {
        return $this->belongsTo(Commande::class, 'id_commande');
    }
}
