<?php namespace Avosalmon\Infrastructure\Store\Sprints;

interface SprintUsersInterface
{
    /**
     * Attach sprint id to user id
     *
     * @param  int $sprintId
     * @param  int $userId
     * @param  array $attributes
     * @return array
     */
    public function attach($sprintId, $userId, $attributes = []);

    /**
     * Update pivot table entry
     *
     * @param  int $sprintId
     * @param  int $userId
     * @param  array $data
     * @return int
     */
    public function update($sprintId, $userId, $data);

    /**
     * Detach sprint id from user id
     *
     * @param  int $sprintId
     * @param  int $userId
     * @return int
     */
    public function detach($sprintId, $userId);

    /**
     * Detach all user ids from given sprint id
     *
     * @param  int $sprintId
     * @return int
     */
    public function detachAll($sprintId);
}
