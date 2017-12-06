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
        $this->sprints->setOffset((int)$this->request->input('offset'));
        $this->sprints->setLimit((int)$this->request->input('limit'));
        $this->sprints->setSort($this->request->input('sort'));
        $this->sprints->setDirection($this->request->input('direction'));

        $sprints = $this->sprints->all();
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

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $this->sprints->setOffset(0);
        $this->sprints->setLimit(1);

        if ($store = $this->sprints->find($id)) {
            $meta = $this->generateResponseMeta($this->sprints, $total = 1);
            return $this->response->json($this->formatResponse($type = 'sprint', $store, $meta));
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {

    }
}
