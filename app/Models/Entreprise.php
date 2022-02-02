<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
class Entreprise extends Model
{
    use HasFactory;
    use HasSlug;

    protected $table = 'entreprises';

    protected $guarded = ['id'];

    public $timestamps = true;

    protected $fillable = [
        'nom',
        'slug',
        'adresse',
        'email',
        'contact',
        'ncc',
        'status'
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nom')
            ->saveSlugsTo('slug');
    }

    public function entrepots()
    {
        return $this->hasMany(Entrepot::class, 'id_entreprise');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'id_entreprise');
    }

    public function commande_fournisseur()
    {
        return $this->hasMany(CommandeFournisseur::class, 'id_entreprise');
    }
}
