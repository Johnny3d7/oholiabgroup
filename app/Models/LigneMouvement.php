<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * @property decimal $quantite quantite
 * @property int $id_products id products
 * @property int $id_entrepots id entrepots
 * @property int $id_mouvements id mouvements
 * @property IdMouvement $mouvement belongsTo
 * @property IdEntrepot $entrepot belongsTo
 * @property IdProduct $product belongsTo
 * 
 */
class LigneMouvement extends BaseModel 
{
    
    /**
    * Database table name
    */
    protected $table = 'ligne_mouvement';

    /**
    * Mass assignable columns
    */
    protected $fillable = ['quantite', 'id_products', 'id_entrepots', 'id_mouvements'];

    /**
    * Date time columns.
    */
    protected $dates=[];

    /**
    * mouvement
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function mouvement()
    {
        return $this->belongsTo(Mouvement::class,'id_mouvements');
    }

    /**
    * entrepot
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function entrepot()
    {
        // return Entrepot::find($this->mouvement->id_entrepots);
        return $this->belongsTo(Entrepot::class,'id_entrepots');
    }

    /**
    * product
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function product()
    {
        return $this->belongsTo(Product::class,'id_products');
    }




}