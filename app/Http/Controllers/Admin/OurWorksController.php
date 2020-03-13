<?php

namespace App\Http\Controllers\Admin;

use App\ApiMenuItem;
use App\InlineBlock;
use App\Libraries\Uploader\UploaderClass;
use App\Page;
use App\Video;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class OurWorksController extends AdminBaseController
{
    protected $entity = 'our_work';

    protected $sortColumns = ['id'];
    /**
     * @var InlineBlock
     */
    protected $project;

    protected $page_block = Page::OUR_WORKS;

    protected $gridData = [
        "columns" => ['name'],
        'entity' => 'our_work',
        'actionsDisplay' => [
            'edit' => 1,
        ]
    ];

    protected $sortColumn = 'id';
    /**
     * @var UploaderClass
     */
    private $uploader;

    public function __construct(Request $request, Page $model, UploaderClass $uploader)
    {
        $this->request = $request;
        $this->model   = $model;
        $this->setMessages();
        $this->setViews();
        parent::__construct();
        $this->uploader = $uploader;
        $this->viewData['options']  = [
            'Сип панели' => 'Сип панели',
            'Отзывы клиентов' => 'Отзывы клиентов'
        ];
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
        $this->viewData['items']    = $this->model->where('page_block', $this->page_block)->orderBy($this->sortColumn, $this->sortOrder)->paginate($this->limit);
        $this->afterInitPaginateHook();
        $this->viewData['gridData'] = $this->gridData;

        return redirect(route('our_work.edit' , $this->viewData['items'][0]->id . '/' . $this->page_block));
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
        $page = Page::wherePageBlock(Page::OUR_WORKS)->first();
        if (!$page) {
            $page = Page::create([
                'name' => "НАШИ РАБОТЫ",
                'page_header' => "НАШИ РАБОТЫ",
                'page_block' => Page::OUR_WORKS
            ]);
            ApiMenuItem::create(['page_id' => $page->id]);
        }
        $this->setPageBlock($page->page_block);
    }

    /**
     * Doing some data operations after updating
     * @param  object $item
     * @return void
     */
    protected function afterUpdateHook($item)
    {
        if ($this->request->hasFile('attachments')) {
            foreach ($this->request->file('attachments') as $attachment) {
                $entity = [
                    'entity_type' => Page::class,
                    'entity_id'   => $item->id,
                    'position'    => 'bottom'
                ];
                $this->uploader->setDirectory('pages_' . $item->id);
                $this->uploader->storeFile($attachment, $entity);
            }
        }

        $this->handlePNActions($item, 'videos', Video::class);
    }

    /**
     * handle the create update delete for proofs and inline_blocks
     *
     * @param $item
     * @param string $relation
     * @param string $class
     */
    protected function handlePNActions($item, $relation = 'inline_blocks', $class = 'App\InlineBlock')
    {
        if (!$this->request->has($relation))
            $this->request[$relation] = [];

        $oldData     = $item->{$relation}->toArray();
        $sortedData  = crudPartition($oldData, $this->request[$relation]);
        foreach ($sortedData['update'] as $update) {
            foreach ($this->request->get($relation) as $key => $value) {
                $file = $this->request->file($relation);
                if ( $file && array_key_exists($key, $file) ) {
                    $entity = [
                        'entity_type' => $class,
                        'entity_id'   => $update['id'],
                        'position'    => 'top'
                    ];
                    $this->uploader->setDirectory($relation . '_' . $update['id']);
                    $this->uploader->storeFile($file[$key]['attachments'], $entity);
                }
            }
            unset($update['attachments']);
            $item->$relation()->whereId($update['id'])->update($update);

        }
        foreach ($sortedData['create'] as $create) {
            $created = $item->$relation()->create($create);
            foreach ($this->request->get($relation) as $key => $value) {
                $file = $this->request->file($relation);
                if ( $file && array_key_exists($key, $file) ) {
                    $entity = [
                        'entity_type' => $class,
                        'entity_id'   => $created->id,
                        'position'    => 'top'
                    ];
                    $this->uploader->setDirectory($relation . '_' . $created->id);
                    $this->uploader->storeFile($file[$key]['attachments'], $entity);
                }
            }
        }
        foreach ($sortedData['delete'] as $delete) {
            $item->$relation()->whereId($delete['id'])->delete();
        }
    }
}
