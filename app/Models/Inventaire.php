<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * @property datetime $date_inventaires date inventaires
 * @property varchar $statut statut
 * @property text $observations observations
 * @property \Illuminate\Database\Eloquent\Collection $ligne belongsToMany
 *
 */
class Inventaire extends BaseModel
{

    /**
    * Database table name
    */
    protected $table = 'inventaires';

    /**
    * Mass assignable columns
    */
    protected $fillable = ['name', 'date_inventaire', 'statut', 'observations', 'id_entreprises', 'id_entrepots', 'vs_inventoriste', 'vs_comptable', 'vs_chef_comptable'];

    /**
    * Date time columns.
    */
    protected $dates=['date_inventaires'];

    /**
    * lignes
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function lignes()
    {
        return $this->hasMany(LigneInventaire::class,'id_inventaires');
    }

    /**
    * entrepot
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function entrepot()
    {
        return $this->belongsTo(Entrepot::class,'id_entrepots');
    }



}
