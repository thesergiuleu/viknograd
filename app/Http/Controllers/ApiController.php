<?php

namespace App\Http\Controllers;

use App\ApiMenuItem;
use App\Page;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getPages()
    {
        return response()->json(Page::with(['attachments', 'inline_blocks', 'inline_blocks.attachments', 'videos'])->get());
    }

    public function menuItems()
    {
        return response()->json(ApiMenuItem::all());
    }
}
