<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
class Product extends Model
{
    use HasFactory;
    use HasSlug;

    protected $table = 'products';

    public $timestamps = true;

    protected $guarded = ['id'];

    protected $fillable = [
        'ref',
        'slug',
        'lib',
        'description',
        'price',
        'stockalert',
        'poids',
        'unite_poids',
        'longueur',
        'largeur',
        'hauteur',
        'unite_mesure',
        'volume',
        'unite_volume',
        'liquide',
        'unite_liquide',
        'status',
        'id_product_category',
        'id_type_product'
    ];
    
    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('ref','lib')
            ->saveSlugsTo('slug');
    }

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'id_product_category');
    }

    public function typeProduct()
    {
        return $this->belongsTo(TypeProduct::class, 'id_type_product');
    }

    public function variations()
    {
        return $this->hasMany(Variation::class, 'id_product');
    }

    /**
    * The roles that belong to the Commande
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'ligne_commandes', 'product_id', 'commande_id')->withPivot('qte', 'prix', 'status')->withTimestamps();
    }
}
