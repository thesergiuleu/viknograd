<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends AdminBaseController
{
    /**
     * Create a new controller instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct();

    }

    /**
     * Show the application dashboard.
     *
     * @param null $page_block
     * @return Factory|View
     */
    public function index($page_block = null)
    {
        return view('dashboard', $this->viewData);
    }
}
