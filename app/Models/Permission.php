<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * @property varchar $uuid__permissions uuid  permissions
 * @property varchar $name_permissions name permissions
 * @property \Illuminate\Database\Eloquent\Collection $roleshass belongsToMany
 * @property \Illuminate\Database\Eloquent\Collection $usershass belongsToMany
 *
 */
class Permission extends Model
{

    /**
    * Database table name
    */
    protected $table = 'permissions';

    /**
    * Mass assignable columns
    */
    protected $fillable = ['name_permissions', 'uuid__permissions', 'name_permissions'];

    /**
    * Date time columns.
    */
    protected $dates=[];

    /**
    * roleshasses
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function roleshasses()
    {
        return $this->belongsToMany(Roleshass::class,'roles_has_permissions');
    }
    /**
    * usershasses
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function usershasses()
    {
        return $this->belongsToMany(Usershass::class,'users_has_permissions');
    }



}
