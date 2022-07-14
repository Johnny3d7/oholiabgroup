<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * @property varchar $statut statut
 * @property decimal $qte_att qte att
 * @property decimal $qte_res qte res
 * @property text $observations observations
 * @property int $id_products id products
 * @property int $id_inventaires id inventaires
 * @property int $id_entrepots id entrepots
 * @property IdEntrepot $entrepot belongsTo
 * @property IdInventaire $inventaire belongsTo
 * @property IdProduct $product belongsTo
 *
 */
class LigneInventaire extends BaseModel
{

    /**
    * Database table name
    */
    protected $table = 'ligne_inventaires';

    /**
    * Mass assignable columns
    */
    protected $fillable = ['id_entrepots', 'statut', 'qte_att', 'qte_res', 'observations', 'id_products', 'id_inventaires', 'id_entrepots'];

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
    * idInventaire
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function idInventaire()
    {
        return $this->belongsTo(Inventaire::class,'id_inventaires');
    }

    /**
    * idProduct
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function idProduct()
    {
        return $this->belongsTo(Product::class,'id_products');
    }




}
