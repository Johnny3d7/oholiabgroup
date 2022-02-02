<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Entrepot extends Model
{
    use HasFactory;
    use HasSlug;

    protected $table = 'entrepots';

    protected $guarded = ['id'];

    public $timestamps = true;

    protected $fillable = [
        'ref',
        'lib',
        'slug',
        'email',
        'contact',
        'lieu',
        'adresse',
        'id_recorder',
        'id_entreprise',
        'status'
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('ref')
            ->saveSlugsTo('slug');
    }

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class, 'id_entreprise');
    }

    public function variations()
    {
        return $this->hasMany(Variation::class, 'id_entrepot');
    }

    public function entrepots_voisin()
    {   
        return self::where(['status'=>1,'id_entreprise'=>$this->id_entreprise])->whereNotIn('id',[$this->id])->orderBy('created_at', 'ASc')->get();
    }

    public function produits(){

        $variations = $this->variations;

        $prodId = $produits = [];

        foreach($variations as $variation){
            if(!in_array($variation->id_product, $prodId)){
                $prodId []= $variation->id_product;
                $produits []= $variation->product;
            }
        }
        return $produits;
    }
}
