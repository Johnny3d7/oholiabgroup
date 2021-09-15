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
        'num_bl',
        'slug',
        'date_reception_livreur',
        'date_reception_client',
        'id_commande',
        'id_livreur',
        'id_entreprise',
        'status'
    ];

    protected $guarded = ['id'];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('num_bl')
            ->saveSlugsTo('slug');
    }

    /*public function commande()
    {
        return $this->belongsTo(Commande::class, 'id_commande');
    }*/

    public function commande_fournisseur()
    {
        return $this->belongsTo(CommandeFournisseur::class, 'id_commande');
    }

    public function livreur()
    {
        return $this->belongsTo(Livreur::class, 'id_livreur');
    }
}
