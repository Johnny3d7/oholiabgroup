<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Facture extends BaseModel
{
    use HasFactory;

    /**
    * Database table name
    */
    protected $table = 'factures';

    /**
    * Mass assignable columns
    */
    protected $fillable = ['uuid', 'reference', 'date_emission', 'montant', 'file', 'id_fournisseurs', 'description'];

    /**
    * Date time columns.
    */
    protected $dates=['date_emission'];

    /**
    * ligne_factures
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function lignes()
    {
        return $this->HasMany(LigneFacture::class,'id_factures');
    }

    /**
    * fournisseur
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class,'id_fournisseurs');
    }


}
