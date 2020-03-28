<?php

namespace App\Http\Controllers\Admin;

use App\Libraries\Uploader\UploaderClass;
use App\Page;
use App\StaticContent;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

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
}
