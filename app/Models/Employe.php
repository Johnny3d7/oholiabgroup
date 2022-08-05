<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * @property varchar $uuid uuid
 * @property varchar $nom nom
 * @property varchar $prenoms prenoms
 * @property varchar $contact contact
 * @property varchar $email email
 * @property date $birthdate birthdate
 * @property date $hiredate hiredate
 * @property \Illuminate\Database\Eloquent\Collection $entrepotshass belongsToMany
 *
 */
class Employe extends BaseModel
{

    /**
    * Database table name
    */
    protected $table = 'employes';

    /**
    * Mass assignable columns
    */
    protected $fillable = ['uuid', 'nom', 'prenoms', 'contact', 'email', 'birthdate', 'hiredate', 'id_entreprises'];

    /**
    * Date time columns.
    */
    protected $dates = ['birthdate', 'hiredate'];

    /**
    * user
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function user()
    {
        return $this->hasOne(User::class,'id_employes');
    }

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class, 'id_entreprises');
    }




}
