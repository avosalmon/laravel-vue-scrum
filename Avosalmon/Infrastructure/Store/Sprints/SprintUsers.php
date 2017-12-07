<?php namespace Avosalmon\Infrastructure\Store\Sprints;

use Illuminate\Database\DatabaseManager;

class SprintUsers implements SprintUsersInterface
{
    /**
     * Variable to hold the instance of the injected dependency.
     *
     * @var Avosalmon\Infrastructure\Store\Sprints\SprintsEloquent
     */
    protected $sprints;

    /**
     * Variable to hold the instance of the injected dependency.
     *
     * @var Illuminate\Database\DatabaseManager
     */
    protected $databaseManager;

    /**
     * Create new instances for dependencies.
     *
     * @param  Avosalmon\Infrastructure\Store\Sprints\SprintsEloquent $sprints
     * @param  Illuminate\Database\DatabaseManager $databaseManager
     * @return void
     */
    public function __construct(SprintsEloquent $sprints, DatabaseManager $databaseManager)
    {
        $this->sprints         = $sprints;
        $this->databaseManager = $databaseManager;
    }

    /**
     * Attach sprint id to user id
     *
     * @param  int $sprintId
     * @param  int $userId
     * @param  array $attributes
     * @return array
     */
    public function attach($sprintId, $userId, $attributes = [])
    {
        return $this->sprints->findOrFail($sprintId)->users()->sync([$userId => $attributes], $detach = false);
    }

    /**
     * Update pivot table entry
     *
     * @param  int $sprintId
     * @param  int $userId
     * @param  array $data
     * @return int
     */
    public function update($sprintId, $userId, $data)
    {
        return $this->databaseManager->table('sprint_users')
                                    ->where('sprint_id', $sprintId)
                                    ->where('user_id', $userId)
                                    ->update($data);
    }

    /**
     * Detach sprint id from user id
     *
     * @param  int $sprintId
     * @param  int $userId
     * @return int
     */
    public function detach($sprintId, $userId)
    {
        return $this->sprints->findOrFail($sprintId)->users()->detach($userId);
    }

    /**
     * Detach all user ids from given sprint id
     *
     * @param  int $sprintId
     * @return int
     */
    public function detachAll($sprintId)
    {
        $count = 0;

        if ($sprint = $this->sprints->find($sprintId)) {
            $count = $sprint->users()->detach();
        }

        return $count;
    }
}
