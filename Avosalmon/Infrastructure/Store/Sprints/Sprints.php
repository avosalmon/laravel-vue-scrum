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

    /**
     * Get single sprint order with nested relationships
     *
     * @param  int $id
     * @param  array $relationships
     * @param  bool $throw
     * @return \Illuminate\Database\Eloquent\Model|Collection|static
     */
    public function findWith($id, $relationships, $throw = false)
    {
        if (! $this->validateRelationships($relationships)) {
            return null;
        }
        if ($throw) {
            return $this->sprints->with($relationships)->findOrFail($id);
        }
        return $this->sprints->with($relationships)->find($id);
    }

    /**
     * Create a new sprint
     *
     * @param  array $data
     * @return \Illuminate\Database\Eloquent\Model|Collection|static
     */
    public function create($data)
    {
        return $this->sprints->create($data);
    }

    /**
     * Update the specified sprint
     *
     * @param  int $id
     * @param  array $data
     * @return bool
     */
    public function update($id, $data)
    {
        $sprint = $this->sprints->find($id);

        return $sprint ? $sprint->update($data) : false;
    }

    /**
     * Validate relationships
     *
     * @param  array $relationships
     * @return array|string|void
     */
    protected function validateRelationships($relationships)
    {
        foreach ($relationships as $relationship) {
            if (! method_exists($this->sprints, explode('.', $relationship)[0])) {
                return false;
            }
        }
        return true;
    }
}
