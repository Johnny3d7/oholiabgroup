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
    protected $fillable = ['uuid', 'reference', 'name', 'type'];

    /**
    * Date time columns.
    */
    protected $dates=[];

    public static function types(){
        return static::whereType('type')->get();
    }

    public static function natures(){
        return static::whereType('nature')->get();
    }

    public static function unites(){
        return static::whereType('unite')->get();
    }

}
