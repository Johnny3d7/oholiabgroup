<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * @property varchar $type type
 * @property int $id_entrepots id entrepots
 * @property int $id_employes id employes
 * @property IdEmploye $employe belongsTo
 * @property IdEntrepot $entrepot belongsTo
 * 
 */
class EntrepotsHasEmploye extends BaseModel 
{
    
    /**
    * Database table name
    */
    protected $table = 'entrepots_has_employes';

    /**
    * Mass assignable columns
    */
    protected $fillable = ['type', 'id_entrepots', 'id_employes'];

    /**
    * Date time columns.
    */
    protected $dates=[];

    /**
    * idEmploye
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function idEmploye()
    {
        return $this->belongsTo(Employe::class,'id_employes');
    }

    /**
    * idEntrepot
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function idEntrepot()
    {
        return $this->belongsTo(Entrepot::class,'id_entrepots');
    }




}