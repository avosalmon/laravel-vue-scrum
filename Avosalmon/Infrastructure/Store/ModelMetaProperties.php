<?php namespace Avosalmon\Infrastructure\Store;

trait ModelMetaProperties
{
    /**
     * Set offset
     *
     * @param int $offset
     * @return void
     */
    public function setOffset($offset)
    {
        if ($offset) {
            $this->offset = $offset;
        }
    }

    /**
     * Get offset
     *
     * @return int
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * Set limit
     *
     * @param int $limit
     * @return void
     */
    public function setLimit($limit)
    {
        if (!$limit) {
            return;
        }

        // avoid querying too big data.
        if (isset($this->maxLimit) && $limit > $this->maxLimit) {
            $this->limit = $maxLimit;
        }

        $this->limit = $limit;
    }

    /**
     * Get Limit
     *
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * Set sort
     *
     * @param string $sort
     * @return void
     */
    public function setSort($sort)
    {
        if ($sort) {
            $this->sort = $sort;
        }
    }

    /**
     * Get sort
     *
     * @return string
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * Set direction
     *
     * @param string $direction
     * @return void
     */
    public function setDirection($direction)
    {
        if ($direction) {
            $this->direction = $direction;
        }
    }

    /**
     * Get direction
     *
     * @return string
     */
    public function getDirection()
    {
        return $this->direction;
    }
}
