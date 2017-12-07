<?php namespace Avosalmon\Infrastructure\Store\Projects;

interface ProjectsInterface
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
     * Get all users
     *
     * @return \Illuminate\Database\Eloquent\Model|Collection|static
     */
    public function all();

    /**
     * Get count for user
     *
     * @return \Illuminate\Database\Eloquent\Model|Collection|static
     */
    public function count();
}
