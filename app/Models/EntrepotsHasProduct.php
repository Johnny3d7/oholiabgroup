<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * @property int $id id
 * @property decimal $quantite quantite
 * @property int $id_entrepots id entrepots
 * @property IdEntrepot $entrepot belongsTo
 * @property Id $product belongsTo
 * 
 */
class EntrepotsHasProduct extends BaseModel 
{
    
    /**
    * Database table name
    */
    protected $table = 'entrepots_has_products';

    /**
    * Mass assignable columns
    */
    protected $fillable = ['quantite', 'id_entrepots'];

    /**
    * Date time columns.
    */
    protected $dates=[];

    /**
    * idEntrepot
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function idEntrepot()
    {
        return $this->belongsTo(Entrepot::class,'id_entrepots');
    }

    /**
    * id
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function id()
    {
        return $this->belongsTo(Product::class,'id');
    }




}