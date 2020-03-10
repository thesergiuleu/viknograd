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

class NewsController extends AdminBaseController
{
    protected $entity = 'new';

    protected $sortColumns = ['id'];
    /**
     * @var InlineBlock
     */
    protected $project;

    protected $page_block = Page::NEWS;

    protected $gridData = [
        "columns" => ['id', 'name'],
        'entity' => 'new',
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
        $this->viewData['items']    = $this->model->whereNotNull('parent_id')->orderBy($this->sortColumn, $this->sortOrder)->paginate($this->limit);
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
        $page = Page::wherePageBlock(Page::NEWS)->first();
        if (!$page) {
            $page = Page::create([
                'name' => "Новости",
                'page_block' => Page::NEWS
            ]);
        }
        $this->setPageBlock($page->page_block);
    }


    protected function afterCreateHook($item)
    {
        if ($this->request->has('inline_blocks')) {
            foreach ($this->request->get('inline_blocks') as $key => $inlineBlock) {
                $block = $item->inline_blocks()->create($inlineBlock);
                $file = $this->request->file('inline_blocks');
                if (array_key_exists($key, $file)) {
                    $entity = [
                        'entity_type' => InlineBlock::class,
                        'entity_id'   => $block->id,
                        'position'    => 'top'
                    ];
                    $this->uploader->setDirectory('inline_blocks_' . $block->id);
                    $this->uploader->storeFile($file[$key]['attachments'], $entity);
                }
            }
        }
        if ($this->request->has('videos')) {
            foreach ($this->request->get('videos')as $video) {
                $item->videos()->create($video);
            }
        }
        if ($this->request->hasFile('attachments')) {
            foreach ($this->request->file('attachments') as $attachment) {
                $entity = [
                    'entity_type' => Page::class,
                    'entity_id'   => $item->id,
                    'position'    => 'top'
                ];
                $this->uploader->setDirectory('pages_' . $item->id);
                $this->uploader->storeFile($attachment, $entity);
            }
        }
        if ($this->request->hasFile('thumbnail')) {
            $entity = [
                'entity_type' => Page::class,
                'entity_id'   => $item->id,
                'position'    => 'top'
            ];
            $this->uploader->setDirectory('thumbnails');
            $this->uploader->storeFile($this->request->file('thumbnail'), $entity);
        }
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
                    'position'    => 'top'
                ];
                $this->uploader->setDirectory('pages_' . $item->id);
                $this->uploader->storeFile($attachment, $entity);
            }
        }
        $this->handlePNActions($item, 'inline_blocks', InlineBlock::class);

        $this->handlePNActions($item, 'videos', Video::class);

        if ($this->request->hasFile('thumbnail')) {
            $entity = [
                'entity_type' => Page::class,
                'entity_id'   => $item->id,
                'position'    => 'top'
            ];
            $this->uploader->setDirectory('thumbnails');
            $this->uploader->storeFile($this->request->file('thumbnail'), $entity);
        }
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
