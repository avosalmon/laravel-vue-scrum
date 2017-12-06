<?php namespace Avosalmon\Infrastructure\Store\Sprints;

use Avosalmon\Infrastructure\Store\ModelMetaProperties;

class Sprints implements SprintsInterface
{
    use ModelMetaProperties;

    /**
     * Variable to hold the instance of the injected dependency.
     *
     * @var Avosalmon\Infrastructure\Store\Sprints\SprintsEloquent
     */
    protected $sprints;

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
     * @param  Avosalmon\Infrastructure\Store\Sprints\SprintsEloquent $sprints
     * @return void
     */
    public function __construct(SprintsEloquent $sprints)
    {
        $this->sprints = $sprints;
    }

    /**
     * Get all sprints
     *
     * @return \Illuminate\Database\Eloquent\Model|Collection|static
     */
    public function all()
    {
        return $this->sprints
                    ->skip($this->offset)
                    ->take($this->limit)
                    ->orderBy($this->sort, $this->direction)
                    ->get();
    }

    /**
     * Get count for sprint
     *
     * @return \Illuminate\Database\Eloquent\Model|Collection|static
     */
    public function count()
    {
        return $this->sprints->count();
    }
}
