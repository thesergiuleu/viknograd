<?php

namespace App\Http\Controllers;

use App\ApiMenuItem;
use App\Attachment;
use App\InlineBlock;
use App\Page;
use App\Video;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getPages()
    {
        $pages = Page::with(['attachments', 'inline_blocks', 'inline_blocks.attachments', 'videos'])->get();
//        $json_data = json_encode($pages);
//        file_put_contents('pages.json', $json_data);
        return response()->json($pages);
    }

    public function menuItems()
    {
        $menuItems = ApiMenuItem::with(['page', 'children'])->whereNull('parent_id')->get();
        $data = $this->_menuItems($menuItems);
//        $json_data = json_encode(ApiMenuItem::all());
//        file_put_contents('menu_items.json', $json_data);
        return response()->json(array_values($data));
    }

    public function inlineBlocks()
    {
        $menuItems = InlineBlock::all();
//        $json_data = json_encode($menuItems);
//        file_put_contents('inline_blocks.json', $json_data);
        return response()->json($menuItems->values());
    }
    public function attachments()
    {
        $menuItems = Attachment::all();
//        $json_data = json_encode($menuItems);
//        file_put_contents('attachments.json', $json_data);
        return response()->json($menuItems->values());
    }
    public function videos()
    {
        $menuItems = Video::all();
//        $json_data = json_encode($menuItems);
//        file_put_contents('videos.json', $json_data);
        return response()->json($menuItems->values());
    }

    public function getPage($id)
    {
        $page = Page::with(['attachments', 'inline_blocks', 'inline_blocks.attachments', 'videos'])->findOrFail($id);
        $page['news'] = Page::wherePageBlock(Page::NEWS)->first() ? Page::wherePageBlock(Page::NEWS)->first()->childrenFormed() : null;

        foreach ($page->inline_blocks as $inline_block) {
            $inline_block->file_url = $inline_block->attachment_url;
        }

        if ($page->page_block == Page::CONTACTS) {
            $blocks = [];
            foreach ($page->inline_blocks->unique('name')->values() as $k => $value) {
                $inlineBlocks = $page->inline_blocks()->where('name', $value->name)->get();
                foreach ($inlineBlocks as $block) {
                    $block->file_url = $block->attachment_url;
                }
                $blocks[$k]['city'] = $value->name;
                $blocks[$k]['persons'] = $inlineBlocks->toArray();
            }
            $page['contacts'] = $blocks;
        }
        if ($page->page_block == Page::OUR_WORKS) {
            $blocks = [];
            foreach ($page->videos->unique('header')->values() as $k => $value) {
                $inlineBlocks = $page->videos()->where('header', $value->header)->get();
                $blocks[$k]['name'] = $value->header;
                $blocks[$k]['list'] = $inlineBlocks->toArray();
            }
            $page['contacts'] = $blocks;
        }
        return response()->json($page);
    }

    private function _menuItems($collection)
    {
        $data = [];
        foreach ($collection as $item) {
            $children = [];
            if ($item->children->isNotEmpty()) {
                $children = $this->_menuItems($item->children);
            }
            $data[$item->id]['page_id']     = $item->page_id;
            $data[$item->id]['name']        = $item->page->name;
            $data[$item->id]['path']        = $item->page->url;
            $data[$item->id]['page_block']  = $item->page->page_block;
            $data[$item->id]['content']     = array_values($children);
        }
        return $data;
    }
}
