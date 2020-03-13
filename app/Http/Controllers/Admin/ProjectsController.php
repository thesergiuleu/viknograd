<?php

namespace App\Http\Controllers\Admin;

use App\ApiMenuItem;
use App\InlineBlock;
use App\Libraries\Uploader\UploaderClass;
use App\Page;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectsController extends AdminBaseController
{
    protected $entity = 'project';

    protected $sortColumns = ['id'];
    /**
     * @var InlineBlock
     */
    protected $project;

    protected $page_block = Page::PROJECTS;

    protected $gridData = [
        "columns" => ['name', 'url'],
        'entity' => 'project',
        'actionsDisplay' => [
            'edit' => 1,
        ]
    ];

    protected $sortColumn = 'id';
    /**
     * @var UploaderClass
     */
    private $uploader;

    /**
     * MediaController constructor.
     * @param Request $request
     * @param InlineBlock $model
     * @param UploaderClass $uploader
     */
    public function __construct(Request $request, InlineBlock $model, UploaderClass $uploader)
    {
        $this->request = $request;
        $this->model   = $model;
        $this->setMessages();
        $this->setViews();
        parent::__construct();
        $this->addNewItemRoute = $this->entity . '.add';
        $this->uploader = $uploader;
    }

    /**
     * Display a listing of the resource.
     *
     * @param $page_block
     * @return Factory|JsonResponse|View
     */
    public function index($page_block = null)
    {
        $this->setPageBlock($page_block);
        $this->beforeInitPaginateHook();
        $this->viewData['items']    = $this->model->whereHas('page', function ($query) {
            $query->where('page_block', $this->page_block);
        })->orderBy($this->sortColumn, $this->sortOrder)->paginate($this->limit);
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

    public function beforeInitPaginateHook()
    {
        $page = Page::wherePageBlock(Page::PROJECTS)->first();
        if (!$page) {
            $page = Page::create([
                'name' => "Проекты",
                'page_block' => Page::PROJECTS
            ]);
            ApiMenuItem::create(['page_id' => $page->id]);
        }
        $this->setPageBlock($page->page_block);
    }


    protected function afterCreateHook($item)
    {
        if ($this->request->hasFile('attachments')) {
            $entity = [
                'entity_type' => InlineBlock::class,
                'entity_id'   => $item->id,
                'position'    => 'top'
            ];
            $this->uploader->setDirectory('inline_blocks_' . $item->id);
            $this->uploader->storeFile($this->request->file('attachments'), $entity);
        }
    }

    protected function afterUpdateHook($item)
    {
        $this->afterCreateHook($item);
    }
}
