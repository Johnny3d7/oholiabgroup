<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
/**
 * @property int $id_users id users
 * @property varchar $title title
 * @property varchar $body body
 * @property varchar $link link
 * @property tinyint $opened opened
 * @property IdUser $user belongsTo
 *
 */
class Notification extends Model
{

    /**
    * Database table name
    */
    protected $table = 'notifications';

    /**
    * Mass assignable columns
    */
    protected $fillable = ['id_users', 'title', 'body', 'link', 'opened', 'type'];

    /**
    * Date time columns.
    */
    protected $dates=[];

    /**
    * idUser
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function user()
    {
        return $this->belongsTo(User::class,'id_users');
    }

    public function type()
    {
        return $this->type ?? 'secondary';
    }

    public function markAsRead()
    {
        $this->update(['opened' => true]);
    }

    public function moment(){
        $datetime = $this->created_at;
        return ucwords((new Carbon($datetime))->locale('fr')->isoFormat('DD/MM/YYYY à HH:mm'));
    }
}
