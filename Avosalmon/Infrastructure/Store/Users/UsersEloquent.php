<?php namespace Avosalmon\Infrastructure\Store\Users;

use Illuminate\Database\Eloquent\Model;

class UsersEloquent extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * Get sprint which are related to this user.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sprint()
    {
        return $this->belongsToMany('Avosalmon\Infrastructure\Store\Sprints\SprintsEloquent', 'sprint_users', 'user_id', 'sprint_id');
    }
}
