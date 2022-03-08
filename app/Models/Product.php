<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
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
        'image',
        'image_path',
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

    public static function selectAll(){
        return static::where('status', 1)->get();
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'id_product_category');
    }

    public function type()
    {
        return $this->belongsTo(TypeProduct::class, 'id_type_product');
    }

    public function variations()
    {
        return $this->hasMany(Variation::class, 'id_product');
    }
    
    public function variation_entrepot(Entrepot $entrepot)
    {
        return $this->variations->where('id_entrepot', $entrepot->id);
    }
    
    public function variation_entreprise(Entreprise $entreprise)
    {
        $entrepots = $entreprise->entrepots;
        $variations = new Collection();
        foreach ($entrepots as $entrepot) {
            foreach ($this->variation_entrepot($entrepot) as $variation) {
                $variations->add($variation);
            }
            // if($this->variation_entrepot($entrepot)){
            // }
        }
        return $variations;
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

    public function bon_commandes()
    {
        return $this->belongsToMany(BonCommande::class, 'ligne_bon_commandes','product_id', 'bon_commande_id')->withPivot('qte','prix', 'status')->withTimestamps();
    }

    public function commande_fournisseurs()
    {
        return $this->belongsToMany(CommandeFournisseur::class, 'ligne_commande_fournisseurs', 'product_id', 'commande_fournisseur_id')->withPivot('qte','prix', 'status')->withTimestamps();
    }

    public function entrepots(){
        $variations = $this->variations;

        $entIds = array_unique($variations->pluck('id_entrepot')->all());

        $entrepots = new Collection();
        foreach ($entIds as $entId) {
            $entrepots->add(Entrepot::find($entId));
        }
        // $entId = $entrepots = [];

        // foreach($variations as $variation){
        //     if(!in_array($variation->id_entrepot, $entId)){
        //         $entId []= $variation->id_entrepot;
        //         $entrepots []= $variation->entrepot;
        //     }
        // }
        return $entrepots;
    }

    public function stock_physique_entrepot(Entrepot $entrepot){
        $entrees = $this->variation_entrepot($entrepot)->sum('qte_entree');
        $sorties = $this->variation_entrepot($entrepot)->sum('qte_sortie');

        return $entrees - $sorties ;
    }

    public function stock_virtuel_entrepot(Entrepot $entrepot){
        $entrees = $this->variation_entrepot($entrepot)->sum('qte_entree');
        $sorties = $this->variation_entrepot($entrepot)->sum('qte_sortie');

        return $entrees - $sorties ;
    }
    
    public function stock_physique_entreprise(Entreprise $entreprise){
        $entrepots = $entreprise->entrepots;
        $somme = 0;
        foreach ($entrepots as $entrepot) {
            $somme += $this->stock_physique_entrepot($entrepot);
        }
        return $somme;
    }

    public function stock_virtuel_entreprise(Entreprise $entreprise){
        $entrepots = $entreprise->entrepots;
        $somme = 0;
        foreach ($entrepots as $entrepot) {
            $somme += $this->stock_virtuel_entrepot($entrepot);
        }
        return $somme;
    }


    /*public function commande_en_cours_entrepot(Entrepot $entrepot){

        $commandes = $this->commandes()-where("")

        return $entrees - $sorties;
    }*/



    
}
