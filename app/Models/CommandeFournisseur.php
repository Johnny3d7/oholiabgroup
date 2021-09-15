<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class CommandeFournisseur extends Model
{
    use HasFactory;
    use HasSlug;

    protected $table = 'commande_fournisseurs';

    protected $guarded = ['id'];

    public $timestamps = true;

    protected $fillable = [
        'num_cmd',
        'slug',
        'lieu_livraison',
        'date_livraison',
        'mode_reglement',
        'type_commande',
        'id_user',
        'id_entreprise',
        'id_fournisseur',
        'observation',
        'status'
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('num_cmd')
            ->saveSlugsTo('slug');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'ligne_commande_fournisseurs', 'commande_fournisseur_id', 'product_id')->withPivot('qte','prix', 'status')->withTimestamps();
    }

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class, 'id_entreprise');
    }

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class, 'id_fournisseur');
    }

    public function livraisons()
    {
        return $this->hasMany(Livraison::class, 'id_commande');
    }

    
}
