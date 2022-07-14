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
    protected $fillable = ['observations', 'date_inventaires', 'statut', 'observations'];

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
        return $this->belongsToMany(Ligne::class,'ligne_inventaires');
    }



}
