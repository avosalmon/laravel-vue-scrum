<?php namespace Avosalmon\Application\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\Controller;
use Avosalmon\Infrastructure\Store\Projects\ProjectsInterface;

class ProjectsController extends Controller
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
     * Projects model instance.
     *
     * @var Avosalmon\Infrastructure\Store\Projects\ProjectsInterface
     */
    protected $projects;

    /**
     * Create new instances for dependencies.
     *
     * @param Illuminate\Http\Request $request
     * @param Illuminate\Contracts\Routing\ResponseFactory $response
     * @param Avosalmon\Infrastructure\Store\Projects\ProjectsInterface $projects
     * @return void
     */
    public function __construct(Request $request, ResponseFactory $response, ProjectsInterface $projects)
    {
        $this->request  = $request;
        $this->response = $response;
        $this->projects = $projects;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->projects->setOffset((int)$this->request->input('offset'));
        $this->projects->setLimit((int)$this->request->input('limit'));
        $this->projects->setSort($this->request->input('sort'));
        $this->projects->setDirection($this->request->input('direction'));

        $projects = $this->projects->all();
        $total    = $this->projects->count();
        $meta     = $this->generateResponseMeta($this->projects, $total);

        return $this->response->json($this->formatResponse($type = 'projects', $projects, $meta));
    }
}
