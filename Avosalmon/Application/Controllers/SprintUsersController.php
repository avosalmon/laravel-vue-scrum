<?php namespace Avosalmon\Application\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\Controller;
use Avosalmon\Infrastructure\Store\Sprints\SprintUsersInterface;

class SprintUsersController extends Controller
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
     * @var Avosalmon\Infrastructure\Store\Sprints\SprintUsersInterface
     */
    protected $sprintUsers;

    /**
     * Create new instances for dependencies.
     *
     * @param Illuminate\Http\Request $request
     * @param Illuminate\Contracts\Routing\ResponseFactory;
     * @param Avosalmon\Infrastructure\Store\Sprints\SprintUsersInterface $sprintUsers
     * @return void
     */
    public function __construct(Request $request, ResponseFactory $response, SprintUsersInterface $sprintUsers)
    {
        $this->request     = $request;
        $this->response    = $response;
        $this->sprintUsers = $sprintUsers;
    }

    /**
     * Shop a newly created resource in storage.
     *
     * @param int $sprintId
     * @param int $userId
     * @return Response
     */
    public function store($sprintId, $userId)
    {
        $input = $this->request->validate([
            'working_days' => 'required|integer'
        ]);

        $this->sprintUsers->attach($sprintId, $userId, $input);

        return $this->response->json([], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $sprintId
     * @param int $userId
     * @return Response
     */
    public function update($sprintId, $userId)
    {
        $input = $this->request->validate([
            'working_days' => 'integer'
        ]);

        $this->sprintUsers->update($sprintId, $userId, $input);

        return $this->response->json();
    }
}
