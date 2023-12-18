<?php

namespace nailfor\shazam\Http\Controllers;

use Illuminate\Http\Request;
use nailfor\shazam\Repositories\OptionsInterface;
use nailfor\shazam\API\Http\Controllers\Controller;
use nailfor\shazam\Repositories\ReferenceRepository;

class WebController extends Controller
{
    protected OptionsInterface $model;

    protected string $view;

    protected array $cant = [
        'store',
        'destroy',
    ];

    public function __construct(ReferenceRepository $model)
    {
        $this->model = $model;
        $this->view = config('shazam.view.web');
    }

    public function index(Request $request): mixed
    {
        $options = $this->model->getOptions($request);

        $view = view($this->view, $options);

        return $view->render();
    }

    protected function beforeShow(array $options, $id = ''): array
    {
        return $options;
    }

    public function show(Request $request, mixed $id): mixed
    {
        $options = $this->model->getOptions($request);
        $resource = $this->beforeShow($options, $id);

        $view = view($this->view, $resource);

        return $view->render();
    }

    public function __call($name, $params)
    {
        if (in_array($name, $this->cant)) {
            return $this->pageNotFound();
        }

        return parent::__call($name, $params);
    }
}
