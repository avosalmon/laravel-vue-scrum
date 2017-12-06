<?php namespace Avosalmon\Infrastructure\Store\Sprints;

interface SprintsInterface
{
    /**
     * Set offset
     *
     * @param  int $offset
     * @return void
     */
    public function setOffset($offset);

    /**
     * Set limit
     *
     * @param  int $limit
     * @return void
     */
    public function setLimit($limit);

    /**
     * Set sort
     *
     * @param  string $sort
     * @return void
     */
    public function setSort($sort);

    /**
     * Set direction
     *
     * @param  string $direction
     * @return void
     */
    public function setDirection($direction);

    /**
     * Get offset
     *
     * @return int
     */
    public function getOffset();

    /**
     * Get limit
     *
     * @return int
     */
    public function getLimit();

    /**
     * Get sort
     *
     * @return string
     */
    public function getSort();

    /**
     * Get direction
     *
     * @return void
     */
    public function getDirection();

    /**
     * Get all products
     *
     * @return \Illuminate\Database\Eloquent\Model|Collection|static
     */
    public function all();

    /**
     * Get count for product
     *
     * @return \Illuminate\Database\Eloquent\Model|Collection|static
     */
    public function count();

    /**
     * Get single sprint order with nested relationships
     *
     * @param  int $id
     * @param  array $relationships
     * @param  bool $throw
     * @return \Illuminate\Database\Eloquent\Model|Collection|static
     */
    public function findWith($id, $relationships, $throw = false);
}
