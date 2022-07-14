<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fournisseur extends BaseModel
{
    use HasFactory;

    /**
    * Database table name
    */
    protected $table = 'fournisseurs';

    /**
    * Mass assignable columns
    */
    protected $fillable = ['uuid', 'name','contact', 'email', 'type', 'localisation', 'image', 'description'];

    /**
    * Date time columns.
    */
    protected $dates=[];

    protected static $prefix = "FOUR";
    public static function boot(){
        parent::boot();

        static::creating(function($item){
            $last = self::all()->last()->id ?? 0; // To add all deleted records
            $num = $last<9 ? "000".($last+1) :
                    ($last<99 ? "00".($last+1) :
                        ($last<999 ? "0".($last+1) :
                            ($last+1)));
            $item->reference = static::$prefix.$num;
        });
    }

    /**
    * parametre
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function parametre($string)
    {
        return $this->belongsTo(Parametre::class,$string)->first();
    }

}
