<?php

namespace App\Models\ParcAuto;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends BaseModel
{
    use HasFactory;

    /**
    * Database table name
    */
    protected $table = 'vehicles';

    /**
    * Mass assignable columns
    */
    protected $fillable=['uuid', 'reference', 'libelle', 'date_acquisition', 'description', 'observations', 'image', 'created_by', 'updated_by', 'deleted_by'];

    /**
    * Date time columns.
    */
    protected $dates=['date_acquisition'];

}
