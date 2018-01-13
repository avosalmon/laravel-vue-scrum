<?php namespace Avosalmon\Application\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\Controller;
use Avosalmon\Infrastructure\Store\Sprints\SprintsInterface;

class SprintsController extends Controller
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
     * @var Avosalmon\Infrastructure\Store\Sprints\SprintsInterface
     */
    protected $sprints;

    /**
     * Create new instances for dependencies.
     *
     * @param Illuminate\Http\Request $request
     * @param Illuminate\Contracts\Routing\ResponseFactory;
     * @param Avosalmon\Infrastructure\Store\Sprints\SprintsInterface $sprints
     * @return void
     */
    public function __construct(Request $request, ResponseFactory $response, SprintsInterface $sprints)
    {
        $this->request  = $request;
        $this->response = $response;
        $this->sprints  = $sprints;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->sprints->setOffset((int)$this->request->input('offset', $this->sprints->getOffset()));
        $this->sprints->setLimit((int)$this->request->input('limit', $this->sprints->getLimit()));
        $this->sprints->setSort($this->request->input('sort', $this->sprints->getSort()));
        $this->sprints->setDirection($this->request->input('direction', $this->sprints->getDirection()));

        $sprints = $this->sprints->all();
        $total   = $this->sprints->count();
        $meta    = $this->generateResponseMeta($this->sprints, $total);

        return $this->response->json($this->formatResponse($type = 'sprints', $sprints, $meta));
    }

    /**
     * Display a listing of the resource with relationships.
     *
     * @param  string $relationships
     * @return Response
     */
    public function with($relationships)
    {
        $relationships = explode(',', $relationships);

        $this->sprints->setOffset((int)$this->request->input('offset', $this->sprints->getOffset()));
        $this->sprints->setLimit((int)$this->request->input('limit', $this->sprints->getLimit()));
        $this->sprints->setSort($this->request->input('sort', $this->sprints->getSort()));
        $this->sprints->setDirection($this->request->input('direction', $this->sprints->getDirection()));

        $sprints = $this->sprints->allWith($relationships);
        $total   = $this->sprints->count();
        $meta    = $this->generateResponseMeta($this->sprints, $total);

        return $this->response->json($this->formatResponse($type = 'sprints', $sprints, $meta));
    }

    /**
     * Shop a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $this->sprints->setOffset(0);
        $this->sprints->setLimit(1);

        $input = $this->request->validate([
            'start_date'         => 'required|date',
            'end_date'           => 'required|date',
            'velocity'           => 'required|integer',
            'available_resource' => 'required',
            'available_points'   => 'required|integer',
            'planned_points'     => 'required|integer'
        ]);

        $sprint = $this->sprints->create($input);
        $meta   = $this->generateResponseMeta($this->sprints, $total = 1);

        return $this->response->json($this->formatResponse($type = 'sprint', $sprint, $meta), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param string $relationships
     * @return Response
     */
    public function showWith($id, $relationships)
    {
        $relationships = explode(',', $relationships);

        $this->sprints->setOffset(0);
        $this->sprints->setLimit(1);

        if ($sprint = $this->sprints->findWith($id, $relationships)) {
            $meta = $this->generateResponseMeta($this->sprints, $total = 1);
            return $this->response->json($this->formatResponse($type = 'sprint', $sprint, $meta));
        }

        return $this->response->json($data = [], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return Response
     */
    public function update($id)
    {
        $input = $this->request->validate([
            'start_date'       => 'date',
            'end_date'         => 'date',
            'velocity'         => 'integer',
            'available_points' => 'integer',
            'planned_points'   => 'integer',
            'actual_points'    => 'integer',
            'logical_points'   => 'integer'
        ]);

        if ($this->sprints->update($id, $input)) {
            return $this->response->json();
        }

        return $this->response->json([], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        if ($this->sprints->destroy($id)) {
            return $this->response->json();
        }

        return $this->response->json([], 404);
    }
}
