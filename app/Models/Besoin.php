<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Besoin extends BaseModel
{
    use HasFactory;
    
    /**
    * Database table name
    */
    protected $table = 'besoins';

    /**
    * Mass assignable columns
    */
    protected $fillable = ['uuid', 'nature', 'date_emission', 'date_livraison', 'statut', 'employe', 'observations', 'id_entreprises'];

    /**
    * Date time columns.
    */
    protected $dates=['date_emission', 'date_livraison'];

    /**
    * idEntreprise
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class,'id_entreprises');
    }

    /**
    * lignes
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function lignes()
    {
        return $this->hasMany(LigneBesoin::class,'id_besoins');
    }

    public function montant()
    {
        $montant = 0;
        foreach ($this->lignes as $ligne) {
            $montant += $ligne->montant();
        }
        return $montant;
    }
}
