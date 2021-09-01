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
        'create_facture',
        'create_bonlivraison',
        'type',
        'id_fournisseur',
        'id_boncommande',
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

    public function bon_commande()
    {
        return $this->belongsTo(BonCommande::class, 'id_boncommande');
    }
}
