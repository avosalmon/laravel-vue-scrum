<?php namespace Avosalmon\Infrastructure\Store\Users;

use Avosalmon\Infrastructure\Store\ModelMetaProperties;

class Users implements UsersInterface
{
    use ModelMetaProperties;

    /**
     * Variable to hold the instance of the injected dependency.
     *
     * @var Avosalmon\Infrastructure\Store\Users\UsersEloquent
     */
    protected $users;

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
     * @param  Avosalmon\Infrastructure\Store\Users\UsersEloquent $users
     * @return void
     */
    public function __construct(UsersEloquent $users)
    {
        $this->users = $users;
    }

    /**
     * Get all users
     *
     * @return \Illuminate\Database\Eloquent\Model|Collection|static
     */
    public function all()
    {
        return $this->users
                    ->skip($this->offset)
                    ->take($this->limit)
                    ->orderBy($this->sort, $this->direction)
                    ->get();
    }

    /**
     * Get count for user
     *
     * @return \Illuminate\Database\Eloquent\Model|Collection|static
     */
    public function count()
    {
        return $this->users->count();
    }
}
