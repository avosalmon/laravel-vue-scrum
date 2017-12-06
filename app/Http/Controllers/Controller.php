<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Make response meta array.
     *
     * @param  \Illuminate\Database\Eloquent\Model|Collection|static $model
     * @param  int $total
     * @return array
     */
    protected function generateResponseMeta($model, $total = 0)
    {
        return [
            'offset'    => $model->getOffset(),
            'limit'     => $model->getLimit(),
            'sort'      => $model->getSort(),
            'direction' => $model->getDirection(),
            'total'     => $total
        ];
    }

    /**
     * Make response array out of input.
     *
     * @param  string $type
     * @param  \Illuminate\Database\Eloquent\Model|Collection|static $data
     * @param  array $meta
     * @return array
     */
    protected function formatResponse($type, $data = null, $meta = null)
    {
        return [
            $type  => $data,
            'meta' => $meta
        ];
    }
}
