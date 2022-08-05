<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'id_employes'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isEmploye()
    {
        return $this->employe != null;
    }

    public function employe()
    {
        return $this->belongsTo(Employe::class, 'id_employes');
    }

    public function image()
    {
        return $this->image ?? 'images/faces/1.jpg';
    }

    public function role()
    {
        $role = ModelHasRole::whereModelType('App\Models\User')->whereModelId($this->id)->first();  // ->get();
        return $role->role();
    }

    public function perms()
    {
        // dd($this->permissions);
        $permissions = new Collection($this->permissions);
        $role_permissions = new Collection();
        foreach ($this->roles as $role) {
            foreach ($role->permissions as $perm) {
                $role_permissions->add($perm);
            }
        }
        return $role_permissions->merge($permissions);
    }

    public function all_notifs()
    {
        return $this->hasMany(Notification::class,'id_users');
    }

    public function notifs()
    {
        // dd(Request::url() ==, $this->all_notifs->where('opened', false));
        foreach ($this->all_notifs->where('opened', false) as $notif) {
            if(Request::url() == $notif->link) $notif->markAsRead();
        }
        return $this->all_notifs->where('opened', false);
    }

    public function home() {
        $user_role = $this->roles->first();
        return $user_role ? json_decode($user_role->home, true) : ['name' => 'modules.index', 'display' => 'Liste des Modules'];
    }

}
