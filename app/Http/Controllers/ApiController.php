<?php

namespace App\Http\Controllers;

use App\ApiMenuItem;
use App\Page;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getPages()
    {
        $pages = Page::with(['attachments', 'inline_blocks', 'inline_blocks.attachments', 'videos'])->get();
        $json_data = ($pages);
        file_put_contents('pages.json', $json_data);
        return response()->json($pages);
    }

    public function menuItems()
    {
        $menuItems = ApiMenuItem::with('page')->get();
        foreach ($menuItems as $menuItem) {
            $menuItem->name = $menuItem->page->name;
        }
        return response()->json($menuItems);
    }

    public function getPage($id)
    {
        $page = Page::with(['attachments', 'inline_blocks', 'inline_blocks.attachments', 'videos'])->findOrFail($id);
        foreach ($page->inline_blocks as $inline_block) {
            $inline_block->file_url = $inline_block->attachment_url;
        }
        return response()->json($page);
    }
}
