<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Commande extends Model
{
    use HasFactory;
    use HasSlug;

    protected $table = 'commandes';

    public $timestamps = true;

    protected $guarded = ['id'];

    protected $fillable = [
        'num_cmd',
        'slug',
        'lieu_livraison',
        'date_livraison',
        'mode_reglement',
        'canal_reception',
        'type',
        'id_client',
        'create_facture',
        'create_bonlivraison',
        'status',
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

    public function client()
    {
        return $this->belongsTo(Client::class, 'id_client');
    }

    public function livraisons()
    {
        return $this->hasMany(Livraison::class, 'id_commande');
    }

   /**
    * The roles that belong to the Commande
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'ligne_commandes', 'commande_id', 'product_id')->withPivot('qte', 'prix', 'status')->withTimestamps();
    }
}
