<?php

namespace App\Http\Controllers\Admin;

use App\Attachment;
use App\InlineBlock;
use App\Libraries\Uploader\UploaderClass;
use App\Page;
use App\StaticContent;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class StaticContentController extends AdminBaseController
{
    protected $entity = 'static_content';

    protected $sortColumns = ['id'];
    protected $limit = 50;
    protected $sortOrder = 'asc';

    public $page_block = null;

    /**
     * @var Page
     */
    protected $page;

    protected $gridData = [
        "columns" => ['title', 'group_by', 'is_active', 'alias'],
        'entity' => 'static_content',
        'actionsDisplay' => [
            'edit' => 1,
        ]
    ];

    protected $sortColumn = 'id';
    /**
     * @var UploaderClass
     */
    private $uploader;

    public function __construct(Request $request, StaticContent $model, UploaderClass $uploader)
    {
        $this->request = $request;
        $this->model   = $model;
        $this->setMessages();
        $this->setViews();
        parent::__construct();
        $this->addNewItemRoute = $this->entity . '.add';
        $this->uploader = $uploader;

        $this->viewData['groupBy'] = [
            StaticContent::GENERIC,
            StaticContent::CONTACTS,
            StaticContent::WORK_HOURS,
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
        $this->viewData['items']    = $this->model->orderBy($this->sortColumn, $this->sortOrder)->paginate($this->limit);
        $this->afterInitPaginateHook();
        $this->viewData['gridData'] = $this->gridData;
        $this->viewData['attachments'] = Attachment::whereEntityType(StaticContent::class)->whereEntityId(StaticContent::ID)->get();

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
            'alias' => 'required'
        ]);
        $validator->after(function ($validator) use ($post) {
           if (StaticContent::query()->where('alias', $post['alias'])->first()) {
               $validator->errors()->add('alias', 'Alias already exist!');
           }
        });
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

    public function attachment()
    {
        $file = $this->request->file('attachments');
        if (!$file) {
           return redirect()->back()->with('message', [
               'msg'  => 'Something went wrong!',
               'type' => 'dangerA',
           ]);
        }
        $entity = [
            'entity_type' => StaticContent::class,
            'entity_id'   => StaticContent::ID,
            'position'    => 'top'
        ];
        $this->uploader->setDirectory('static_content_' . StaticContent::ID);
        $this->uploader->storeFile($file, $entity);
        return redirect()->back()->with('message', [
            'msg'  => 'Banner updated',
            'type' => 'success',
        ]);
    }
}
