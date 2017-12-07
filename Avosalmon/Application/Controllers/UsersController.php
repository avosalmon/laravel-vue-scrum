<?php namespace Avosalmon\Application\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\Controller;
use Avosalmon\Infrastructure\Store\Users\UsersInterface;

class UsersController extends Controller
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
     * Users model instance.
     *
     * @var Avosalmon\Infrastructure\Store\Users\UsersInterface
     */
    protected $users;

    /**
     * Create new instances for dependencies.
     *
     * @param Illuminate\Http\Request $request
     * @param Illuminate\Contracts\Routing\ResponseFactory;
     * @param Avosalmon\Infrastructure\Store\Users\UsersInterface $users
     * @return void
     */
    public function __construct(Request $request, ResponseFactory $response, UsersInterface $users)
    {
        $this->request  = $request;
        $this->response = $response;
        $this->users    = $users;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->users->setOffset((int)$this->request->input('offset'));
        $this->users->setLimit((int)$this->request->input('limit'));
        $this->users->setSort($this->request->input('sort'));
        $this->users->setDirection($this->request->input('direction'));

        $users = $this->users->all();
        $total = $this->users->count();
        $meta = $this->generateResponseMeta($this->users, $total);

        return $this->response->json($this->formatResponse($type = 'users', $users, $meta));
    }
}
