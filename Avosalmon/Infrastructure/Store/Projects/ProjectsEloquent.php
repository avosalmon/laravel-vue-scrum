<?php namespace Avosalmon\Infrastructure\Store\Projects;

use Illuminate\Database\Eloquent\Model;

class ProjectsEloquent extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'projects';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get sprint which are related to this project.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sprint()
    {
        return $this->belongsToMany('Avosalmon\Infrastructure\Store\Sprints\SprintsEloquent', 'sprint_projects', 'project_id', 'sprint_id');
    }
}
