<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
class Fournisseur extends Model
{
    use HasFactory;
    use HasSlug;

    protected $table = 'fournisseurs';

    protected $guarded = ['id'];

    public $timestamps = true;

    protected $fillable = [
        'slug',
        'nom',
        'email',
        'contact',
        'adresse',
        'ncc',
        'status',
        'id_type_fournisseur'
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('codefour','nom')
            ->saveSlugsTo('slug');
    }

    public function variations()
    {
        return $this->hasMany(Variation::class, 'id_fournisseur');
    }

    public function typeFournisseur()
    {
        return $this->belongsTo(TypeFournisseur::class, 'id_type_fournisseur');
    }

    public function bon_commande()
    {
        return $this->hasMany(BonCommande::class, 'id_fournisseur');
    }

    public function commande_fournisseur()
    {
        return $this->hasMany(CommandeFournisseur::class, 'id_fournisseur');
    }
}
