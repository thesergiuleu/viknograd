<?php

namespace App\Http\Controllers\Admin;

use App\ApiMenuItem;
use App\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiMenuItemsController extends AdminBaseController
{
    protected $entity = 'menu_item';

    protected $sortColumns = ['id'];
    /**
     * @var ApiMenuItem
     */
    protected $menu_item;
    protected $limit = 50;


    protected $gridData = [
        "columns" => ['id'],
        'entity' => 'menu_item',
    ];

    protected $sortColumn = 'id';
    protected $sortOrder = 'asc';


    /**
     * MediaController constructor.
     * @param Request $request
     * @param ApiMenuItem $model

     */
    public function __construct(Request $request, ApiMenuItem $model)
    {
        $this->request = $request;
        $this->model   = $model;
        $this->setMessages();
        $this->setViews();
        parent::__construct();
        $this->gridData['columns'][] = [
            'original_field' => 'page',
            'callback'       => function (ApiMenuItem $item) {
                return $item->page ? $item->page->name : "";
            },
        ];
    }
    public function index($page_block = null)
    {
        $this->setPageId($page_block);
        $this->beforeInitPaginateHook();
        $this->viewData['items']    = $this->model->whereNull('parent_id')->orderBy($this->sortColumn, $this->sortOrder)->paginate($this->limit);
        $this->afterInitPaginateHook();
        $this->viewData['gridData'] = $this->gridData;

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $this->viewData['items'],
            ]);
        }
        $this->viewData['parent_pages'] = ApiMenuItem::query()->whereNull('parent_id')->get()->pluck('page_name', 'id')->toArray();
        $this->viewData['addNewRoute'] = $this->addNewItemRoute;
        $this->setQueryString();
        return view($this->entityViews['list'], $this->viewData);
    }

}
