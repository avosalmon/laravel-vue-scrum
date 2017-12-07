<?php namespace Avosalmon\Infrastructure\Store\Projects;

use Avosalmon\Infrastructure\Store\ModelMetaProperties;

class Projects implements ProjectsInterface
{
    use ModelMetaProperties;

    /**
     * Variable to hold the instance of the injected dependency.
     *
     * @var Avosalmon\Infrastructure\Store\Projects\ProjectsEloquent
     */
    protected $projects;

    /**
     * Offset for queries made by this instance.
     *
     * @var int
     */
    protected $offset = 0;

    /**
     * Limit for queries made by this instance.
     *
     * @var int
     */
    protected $limit = 10;

    /**
     * Sort column for queries made by this instance.
     *
     * @var string
     */
    protected $sort = 'id';

    /**
     * Sort direction for queries made by this instance.
     *
     * @var string
     */
    protected $direction = 'asc';

    /**
     * MaxLimit for queries made by this instance.
     *
     * @var int
     */
    protected $maxLimit = 1000;

    /**
     * Create new instances for dependencies.
     *
     * @param  Avosalmon\Infrastructure\Store\Projects\ProjectsEloquent $projects
     * @return void
     */
    public function __construct(ProjectsEloquent $projects)
    {
        $this->projects = $projects;
    }

    /**
     * Get all projects
     *
     * @return \Illuminate\Database\Eloquent\Model|Collection|static
     */
    public function all()
    {
        return $this->projects
                    ->skip($this->offset)
                    ->take($this->limit)
                    ->orderBy($this->sort, $this->direction)
                    ->get();
    }

    /**
     * Get count for project
     *
     * @return \Illuminate\Database\Eloquent\Model|Collection|static
     */
    public function count()
    {
        return $this->projects->count();
    }
}
