<?php

namespace App\Http\Controllers\Admin;

use App\Attachment;
use App\InlineBlock;
use App\Libraries\Uploader\UploaderClass;
use App\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends AdminBaseController
{
    protected $entity = 'page';

    protected $sortColumns = ['id'];
    /**
     * @var Page
     */
    protected $page;

    protected $gridData = [
        "columns" => ['id', 'name', 'url'],
        'entity' => 'page',
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
     *
     * Doing some actions after creating new item
     * @param object $item
     * @return void
     */
    protected function afterCreateHook($item)
    {
        if ($this->request->has('inline_blocks')) {
            foreach ($this->request->get('inline_blocks') as $key => $inlineBlock) {
                $block = $item->inlineBlocks()->create($inlineBlock);
                $file = $this->request->file('inline_blocks');
                if (array_key_exists($key, $file)) {
                    $entity = [
                        'entity_type' => InlineBlock::class,
                        'entity_id'   => $block->id,
                        'position'    => 'top'
                    ];
                    $this->uploader->setDirectory('inline_block_' . $block->id);
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
                $this->uploader->setDirectory('page_' . $item->id);
                $this->uploader->storeFile($attachment, $entity);
            }
        }
        $item->apiMenuItem()->create(['page_id' => $item->id]);
    }
}
