<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class ModelHasRole extends Model
{
    use HasFactory;

    protected $table = 'model_has_roles';

    // public static function user ()
    // {
    //     return static::where('model_type', 'App\Models\User')->get();
    // }

    public function user()
    {
        return $this->belongsTo(User::class, 'model_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
