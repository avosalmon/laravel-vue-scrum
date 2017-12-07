<?php namespace Avosalmon\Application\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\Controller;
use Avosalmon\Infrastructure\Store\Sprints\SprintProjectsInterface;

class SprintProjectsController extends Controller
{
    /**
     * Request class instance.
     *
     * @var Illuminate\Http\Request
     */
    protected $request;

    /**
     * The ResponseFactory class instance.
     *
     * @var Illuminate\Contracts\Routing\ResponseFactory;
     */
    protected $response;

    /**
     * Sprints model instance.
     *
     * @var Avosalmon\Infrastructure\Store\Sprints\SprintProjectsInterface
     */
    protected $sprintProjects;

    /**
     * Create new instances for dependencies.
     *
     * @param Illuminate\Http\Request $request
     * @param Illuminate\Contracts\Routing\ResponseFactory;
     * @param Avosalmon\Infrastructure\Store\Sprints\SprintProjectsInterface $sprintProjects
     * @return void
     */
    public function __construct(Request $request, ResponseFactory $response, SprintProjectsInterface $sprintProjects)
    {
        $this->request        = $request;
        $this->response       = $response;
        $this->sprintProjects = $sprintProjects;
    }

    /**
     * Shop a newly created resource in storage.
     *
     * @param int $sprintId
     * @param int $projectId
     * @return Response
     */
    public function store($sprintId, $projectId)
    {
        $input = $this->request->validate([
            'planned_points' => 'required|integer',
            'actual_points'  => 'integer'
        ]);

        $this->sprintProjects->attach($sprintId, $projectId, $input);

        return $this->response->json([], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $sprintId
     * @param int $projectId
     * @return Response
     */
    public function update($sprintId, $projectId)
    {
        $input = $this->request->validate([
            'planned_points' => 'integer',
            'actual_points'  => 'integer'
        ]);

        if ($this->sprintProjects->update($sprintId, $projectId, $input)) {
            return $this->response->json();
        }

        return $this->response->json([], 404);
    }
}
