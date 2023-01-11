<?php

namespace App\Models\ParcInfo;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeDevice extends BaseModel
{
    use HasFactory;

    /**
    * Database table name
    */
    protected $table = 'type_devices';

    /**
    * Mass assignable columns
    */
    protected $fillable=['uuid', 'reference', 'libelle', 'image', 'description', 'observations', 'created_by', 'updated_by', 'deleted_by'];

    /**
    * Date time columns.
    */
    protected $dates=[];

}
