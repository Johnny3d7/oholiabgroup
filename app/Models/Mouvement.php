<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * @property varchar $uuid uuid
 * @property datetime $date_mouvements date mouvements
 * @property varchar $type type
 * @property \Illuminate\Database\Eloquent\Collection $ligne belongsToMany
 * 
 */
class Mouvement extends BaseModel 
{
    
    /**
    * Database table name
    */
    protected $table = 'mouvements';

    /**
    * Mass assignable columns
    */
    protected $fillable = ['uuid', 'date_mouvement', 'type', 'observation', 'id_entrepots'];

    /**
    * Date time columns.
    */
    protected $dates=['date_mouvements'];

    /**
    * lignes
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function lignes()
    {
        return $this->belongsToMany(Ligne::class,'ligne_mouvement');
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