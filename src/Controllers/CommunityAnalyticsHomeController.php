<?php

namespace CommunityAnalytics\Controllers;

use Azuriom\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;

class CommunityAnalyticsHomeController extends Controller
{
    /**
     * Show the home plugin page.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        return view('community-analytics::settings');
    }
}
