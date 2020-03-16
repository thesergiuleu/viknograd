<?php

namespace App\Http\Controllers\Admin;

use App\ApiMenuItem;
use App\Attachment;
use App\InlineBlock;
use App\Libraries\Uploader\UploaderClass;
use App\Page;
use App\Video;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class PageController extends AdminBaseController
{
    protected $entity = 'page';

    protected $sortColumns = ['id'];
    protected $limit = 50;
    protected $sortOrder = 'asc';

    /**
     * @var Page
     */
    protected $page;

    protected $gridData = [
        "columns" => ['name', 'url'],
        'entity' => 'page',
        'actionsDisplay' => [
            'edit' => 1,
            'info' => 1
        ]
    ];

    protected $sortColumn = 'top_position';
    /**
     * @var UploaderClass
     */
    private $uploader;

    /**
     * MediaController constructor.
     * @param Request $request
     * @param Page $model
     * @param UploaderClass $uploader
     */
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
        $this->viewData['items']    = ApiMenuItem::query()->whereNull('parent_id')->orderBy($this->sortColumn, $this->sortOrder)->paginate($this->limit);
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
        $validator = Validator::make($data, [
            'name' => 'required|min:3'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($data);
        }
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
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     *
     * @return JsonResponse|RedirectResponse|Response|Redirector
     */
    public function store(Request $request)
    {
        $post = $request->all();
        $validator = Validator::make($post, [
            'name' => 'required|min:3'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($post);
        }
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
     *
     * Doing some actions after creating new item
     * @param object $item
     * @return void
     */
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
        $maxTopPosition = ApiMenuItem::query()->max('top_position');
        $item->apiMenuItem()->create(['page_id' => $item->id, 'top_position' => $maxTopPosition+1]);
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
