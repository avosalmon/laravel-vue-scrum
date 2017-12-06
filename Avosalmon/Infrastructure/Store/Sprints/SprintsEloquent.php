<?php namespace Avosalmon\Infrastructure\Store\Sprints;

use Illuminate\Database\Eloquent\Model;

class SprintsEloquent extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sprints';

    /**
     * Get users which are related to this product.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('Avosalmon\Infrastructure\Store\Users\UsersEloquent', 'sprint_users', 'sprint_id', 'user_id');
    }

    /**
     * Get projects which are related to this product.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function projects()
    {
        return $this->belongsToMany('Avosalmon\Infrastructure\Store\Projects\ProjectsEloquent', 'sprint_projects', 'sprint_id', 'project_id');
    }
}
