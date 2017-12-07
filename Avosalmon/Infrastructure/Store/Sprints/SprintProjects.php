<?php namespace Avosalmon\Infrastructure\Store\Sprints;

use Illuminate\Database\DatabaseManager;

class SprintProjects implements SprintProjectsInterface
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
        $this->sprints = $sprints;
        $this->databaseManager = $databaseManager;
    }

    /**
     * Attach sprint id to project id
     *
     * @param  int $sprintId
     * @param  int $projectId
     * @param  array $attributes
     * @return array
     */
    public function attach($sprintId, $projectId, $attributes = [])
    {
        return $this->sprints->findOrFail($sprintId)->projects()->sync([$projectId => $attributes], $detach = false);
    }

    /**
     * Update pivot table entry
     *
     * @param  int $sprintId
     * @param  int $projectId
     * @param  array $data
     * @return int
     */
    public function update($sprintId, $projectId, $data)
    {
        return $this->databaseManager->table('sprint_projects')
                                    ->where('sprint_id', $sprintId)
                                    ->where('project_id', $projectId)
                                    ->update($data);
    }

    /**
     * Detach sprint id from project id
     *
     * @param  int $sprintId
     * @param  int $projectId
     * @return int
     */
    public function detach($sprintId, $projectId)
    {
        return $this->sprints->findOrFail($sprintId)->projects()->detach($projectId);
    }

    /**
     * Detach all project ids from given sprint id
     *
     * @param  int $sprintId
     * @return int
     */
    public function detachAll($sprintId)
    {
        $count = 0;

        if ($sprint = $this->sprints->find($sprintId)) {
            $count = $sprint->projects()->detach();
        }

        return $count;
    }
}
