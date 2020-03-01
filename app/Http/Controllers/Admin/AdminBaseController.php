<?php

namespace App\Http\Controllers\Admin;

use App\InlineBlock;
use App\Libraries\Uploader\UploaderClass;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class AdminBaseController extends Controller
{
    /**
     * @var Builder
     */
    protected $model;
    /**
    * @var array data
    */
    protected $viewData = [];
    /**
     * @var array data
     */
    protected $gridData = [];

    /**
     * @var array names
     */
    protected $entityViews = [];

    /**
     * @var  array to be sorted
     */
    protected $sortColumns = [];

    /**
     * @var array
     */
    protected $messages = [
        'created' => '',
        'updated' => '',
        'deleted' => '',
    ];

    /**
     * HTTP request for retrieving user input
     *
     * @var Request
     */
    protected $request;

    /**
     * setting paginate limit
     *
     * @var integer
     */
    protected $limit = 20;

    protected $redirectBack = '/admin/page';

    protected $addNewItemRoute = '';

    protected $entity = '';

    protected $page_block;

    protected $sortColumn = 'id';

    protected $sortOrder = 'desc';

    protected $queryString = '';

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->viewData['pages']            = config('admin.pages');
        $this->viewData['activeRoute']      = $this->extractEntityFromRoute(Route::currentRouteName());
        $url = request()->url();
        preg_match("/\/(\d+)$/",$url,$matches);
        if (!empty($matches)) {
            $this->setPageId($matches[1]);
        }
        $this->viewData['entity']           = $this->entity;
        $this->viewData['page_block']          = $this->page_block;
        $this->gridData['showSearch']       = false;
        $this->gridData['filterAttributes'] = [];
        $this->gridData['page_block']          = $this->page_block;
        $this->redirectBack                 = '/admin/' . $this->entity;

        if($this->request->has('orderColumn')) {
            $this->sortColumn = $this->request->input('orderColumn');
            $this->sortOrder = $this->request->input('sortedOrder');
        }
        $this->setSorting();

    }

    public function setPageId($page_block)
    {
        $this->page_block = $page_block;
    }
    /**
     * Display a listing of the resource.
     *
     * @param $page_block
     * @return Factory|JsonResponse|View
     */
    public function index($page_block = null)
    {
        $this->setPageId($page_block);
        $this->beforeInitPaginateHook();
        $this->viewData['items']    = $this->model->orderBy($this->sortColumn, $this->sortOrder)->paginate($this->limit);
        $this->afterInitPaginateHook();
        $this->viewData['gridData'] = $this->gridData;

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $this->viewData['items'],
            ]);
        }
        $this->viewData['addNewRoute'] = $this->addNewItemRoute;
        $this->setQueryString();
        return view($this->entityViews['list'], $this->viewData);
    }


    /**
     * Display a add new item form.
     *
     * @param null $page_block
     * @return Factory|View
     */
    public function add($page_block = null)
    {
        $this->setPageId($page_block);
        $this->beforeSetAddFormHook();

        return view($this->entityViews['add'], $this->viewData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     *
     * @return JsonResponse|RedirectResponse|Response|Redirector
     */
    public function store(Request $request)
    {
        $post = $request->all();

        $post = $this->beforeCreateHook($post);
        $item = $this->model->create($post);

        $this->afterCreateHook($item);
        $response = [
            'message' => $this->messages['created'],
            'data'    => $item->toArray(),
        ];

        if ($request->wantsJson()) {
            return response()->json($response);
        }

        $session = session()->all();
        $routeSuffix = session()->has('query_string') ? '?'.implode('&', $session['query_string']):'';
        return redirect($this->redirectBack . '/' . $post['page_block'] . $routeSuffix)->with('message', [
            'msg'  => $response['message'],
            'type' => 'success',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @param null $page_block
     * @return Factory|Response|View
     */
    public function edit($id, $page_block = null)
    {
        $this->setPageId($page_block);
        $this->viewData['item'] = $this->model->findOrFail($id);
        $this->beforeSetEditFormHook($id);
        return view($this->entityViews['edit'], $this->viewData);
    }



    /**
     * Show info
     *
     * @param  int $id
     *
     * @return Factory|Response|View
     */
    public function show($id)
    {
        $this->viewData['item'] = $this->model->findOrFail($id);
        $this->beforeInitShowHook($this->viewData['item']);
        return view($this->entityViews['show'], $this->viewData);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  string $id
     *
     * @return JsonResponse|RedirectResponse|Response|Redirector
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $put  = $this->beforeUpdateHook($data);
        $item = $this->model->findOrFail($id);
        $item->fill($put);
        $item->save();
        $this->afterUpdateHook($item);

        $response = [
            'message' => $this->messages['updated'],
            'data'    => $item->toArray(),
        ];

        if ($request->wantsJson()) {
            return response()->json($response);
        }

        $session = session()->all();
        $routeSuffix = session()->has('query_string') ? '?'.implode('&', $session['query_string']):'';
        return redirect($this->redirectBack. '/' . $put['page_block'] . $routeSuffix)->with('message', [
            'msg'  => $response['message'],
            'type' => 'success',
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return JsonResponse|RedirectResponse|Redirector
     * @throws \Exception
     */
    public function destroy($id)
    {
        $deleted = $this->model->findOrFail($id)->delete();

        dd($deleted);
        if (request()->wantsJson()) {
            return response()->json([
                'message' => $this->messages['deleted'],
                'deleted' => $deleted,
            ]);
        }

        return redirect($this->redirectBack)->with('message', $this->messages['deleted']);
    }

    /**
     * Sets action messages for CRUD operations
     *
     * @param  string $entity
     *
     * @return void
     */
    protected function setMessages($entity = null)
    {
        $entity = (!is_null($entity) ? ucfirst($entity) : ucfirst($this->entity));
        $this->messages = [
            'created' => __('messages.success-created', ['entity' => $entity]),
            'updated' => __('messages.success-updated', ['entity' => $entity]),
            'deleted' => __('messages.success-deleted', ['entity' => $entity]),
        ];
    }

    /**
     * Sets views for CRUD
     *
     * @param  string $entity
     *
     * @return void
     */
    protected function setViews($entity = null)
    {
        $entity            = (!is_null($entity) ? $entity : $this->entity) . 's';
        $this->entityViews = [
            'list' => 'admin.' . $entity . '.index',
            'add'  => 'admin.' . $entity . '.add',
            'edit' => 'admin.' . $entity . '.edit',
            'show' => 'admin.' . $entity . '.show',
        ];
    }

    /**
     * Doing some actions before loading add form
     * @return void
     */
    protected function beforeSetAddFormHook()
    {
    }

    /**
     * Doing some actions in index method before doing a call to the database
     * @return void
     */
    protected function beforeInitPaginateHook()
    {
    }

    /**
     * Doing some actions in index method after doing a call to the database
     * @return void
     */
    protected function afterInitPaginateHook()
    {
    }

    /**
     * Doing some actions before loading edit form
     * @param  int $id
     * @return void
     */
    protected function beforeSetEditFormHook($id)
    {
    }

    /**
     * Doing some actions before loading show page
     * @param $item
     * @return void
     */
    protected function beforeInitShowHook($item)
    {
    }

    /**
     * Doing some actions before creating new item
     *
     * @param array $item
     * @return array
     */
    protected function beforeCreateHook(array $item)
    {
        return $item;
    }

    /**
     *
     * Doing some actions after creating new item
     * @param object $item
     * @return void
     */
    protected function afterCreateHook($item)
    {
    }

    /**
     * Doing some data operations before updating
     * @param array $put
     * @return array
     */
    protected function beforeUpdateHook(array $put)
    {
        return $put;
    }
    /**
     * Doing some data operations after updating
     * @param  object $item
     * @return void
     */
    protected function afterUpdateHook($item)
    {
    }
    /**
    * Gets current entity name from the route
    *
    * @param  string $currentRoute
    *
    * @return string
    */
    protected function extractEntityFromRoute($currentRoute)
    {
        $route = explode('.', $currentRoute);
        return (is_array($route) ? $route[0] : $route);
    }

    /**
     * Sets sorting params
     *
     * @return void
     */
    protected function setSorting()
    {
        if (count($this->sortColumns) > 0) {
            $this->gridData['sort']['column']  = $this->request->has('orderColumn') ? $this->request->get('orderColumn') : 'id';
            $this->gridData['sort']['order']   = $this->request->has('sortedOrder') ? $this->request->get('sortedOrder') : 'asc';
            $this->gridData['sort']['columns'] = $this->sortColumns;
        }
    }


    /**
     * Sets sorting params
     *
     * @return void
     */
    protected function setQueryString()
    {
        session()->remove('query_string');
        session()->push('query_string', $this->request->server->get('QUERY_STRING'));

    }
}
