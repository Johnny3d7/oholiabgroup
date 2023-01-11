<?php

namespace App\Models\ParcInfo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeHasDevice extends Model
{
    use HasFactory;

    /**
    * Database table name
    */
    protected $table = 'employe_has_devices';

    /**
    * Mass assignable columns
    */
    protected $fillable=['id_employes', 'date_cession'];

    /**
    * Date time columns.
    */
    protected $dates=['date_cession'];


}
