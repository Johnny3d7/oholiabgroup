<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class LigneFacture extends BaseModel
{
    use HasFactory;

    /**
    * Database table name
    */
    protected $table = 'ligne_factures';

    /**
    * Mass assignable columns
    */
    protected $fillable = ['uuid', 'id_ligne_besoins', 'observations', 'id_factures'];

    /**
    * Date time columns.
    */
    protected $dates=[];

    /**
    * idFacture
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function facture()
    {
        return $this->belongsTo(Facture::class,'id_factures');
    }

    public function ligne()
    {
        return $this->belongsTo(LigneBesoin::class,'id_ligne_besoins');
    }
}
