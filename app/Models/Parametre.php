<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property varchar $uuid uuid
 * @property varchar $reference reference
 * @property varchar $name name
 * @property varchar $type type
 *
 */

class Parametre extends BaseModel
{
    use HasFactory;

    /**
    * Database table name
    */
    protected $table = 'parametres';

    /**
    * Mass assignable columns
    */
    protected $fillable = ['uuid', 'reference', 'name', 'type', 'table'];

    /**
    * Date time columns.
    */
    protected $dates=[];

    /********* Products **********/
    public static function p_types(){
        return static::whereTable('products')->whereType('type')->get();
    }

    public static function p_natures(){
        return static::whereTable('products')->whereType('nature')->get();
    }

    public static function p_unites(){
        return static::whereTable('products')->whereType('unite')->get();
    }

    /********* Fournisseurs **********/
    public static function f_types(){
        return static::whereTable('fournisseurs')->whereType('type')->get();
    }

}
