<?php

namespace App\Http\Controllers\Admin;

use App\InlineBlock;
use App\Libraries\Uploader\UploaderClass;
use App\Page;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InlineBlockController extends AdminBaseController
{
    protected $entity = 'inline_block';

    protected $sortColumns = ['id'];
    /**
     * @var InlineBlock
     */
    protected $page;

    protected $page_block = null;

    protected $gridData = [
        "columns" => ['id', 'name', 'url'],
        'entity' => 'inline_block',
        'actionsDisplay' => [
            'edit' => 1,
            'info' => 1
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
        $this->setPageId($page_block);
        $this->beforeInitPaginateHook();
        $this->viewData['items']    = $this->model->where('page_id', $this->page_block)->orderBy($this->sortColumn, $this->sortOrder)->paginate($this->limit);
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
        }
        $this->setPageId($page->id);
    }

    /**
     * @param array $item
     * @return array|void
     */
    public function beforeCreateHook(array $item)
    {
        $item['page_id'] = Page::wherePageBlock($item['page_block'])->first()->id;
        return $item;
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
}
