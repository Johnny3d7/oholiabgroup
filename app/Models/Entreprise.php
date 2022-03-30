<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * @property varchar $uuid uuid
 * @property varchar $name name
 * @property varchar $ncc ncc
 * @property varchar $email email
 * @property varchar $contact contact
 * @property varchar $addresse addresse
 * @property \Illuminate\Database\Eloquent\Collection $entrepot belongsToMany
 * 
 */
class Entreprise extends BaseModel 
{
    
    /**
    * Database table name
    */
    protected $table = 'entreprises';

    /**
    * Mass assignable columns
    */
    protected $fillable = ['addresse', 'uuid', 'name', 'ncc', 'email', 'contact', 'addresse'];

    /**
    * Date time columns.
    */
    protected $dates=[];

    /**
    * entrepots
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function entrepots()
    {
        return $this->belongsToMany(Entrepot::class,'entrepots');
    }



}