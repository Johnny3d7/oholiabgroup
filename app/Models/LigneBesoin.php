<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LigneBesoin extends BaseModel
{
    use HasFactory;

    /**
    * Database table name
    */
    protected $table = 'ligne_besoins';

    /**
    * Mass assignable columns
    */
    protected $fillable = ['uuid', 'article', 'quantite', 'prix', 'unite', 'observations', 'statut', 'motif', 'id_besoins'];

    /**
    * Date time columns.
    */
    protected $dates=[];

    /**
    * idBesoin
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function besoin()
    {
        return $this->belongsTo(Besoin::class,'id_besoins');
    }

    public function montant()
    {
        return $this->quantite * $this->prix;
    }

    public function ligne_facture()
    {
        return $this->hasOne(LigneFacture::class,'id_ligne_besoins');
    }

}
