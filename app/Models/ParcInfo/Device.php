<?php

namespace App\Models\ParcInfo;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends BaseModel
{
    use HasFactory;

    /**
    * Database table name
    */
    protected $table = 'devices';

    /**
    * Mass assignable columns
    */
    protected $fillable=['uuid', 'reference', 'libelle', 'date_acquisition', 'description', 'observations', 'created_by', 'updated_by', 'deleted_by', 'id_types'];

    /**
    * Date time columns.
    */
    protected $dates=['date_acquisition'];

    public function categorie(){
        return $this->belongsTo(TypeDevice::class, 'id_types');
    }
}
