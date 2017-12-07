<?php namespace Avosalmon\Infrastructure\Store\Sprints;

interface SprintProjectsInterface
{
    /**
     * Attach sprint id to project id
     *
     * @param  int $sprintId
     * @param  int $projectId
     * @param  array $attributes
     * @return array
     */
    public function attach($sprintId, $projectId, $attributes = []);

    /**
     * Update pivot table entry
     *
     * @param  int $sprintId
     * @param  int $projectId
     * @param  array $data
     * @return int
     */
    public function update($sprintId, $projectId, $data);

    /**
     * Detach sprint id from project id
     *
     * @param  int $sprintId
     * @param  int $projectId
     * @return int
     */
    public function detach($sprintId, $projectId);

    /**
     * Detach all project ids from given sprint id
     *
     * @param  int $sprintId
     * @return int
     */
    public function detachAll($sprintId);
}
