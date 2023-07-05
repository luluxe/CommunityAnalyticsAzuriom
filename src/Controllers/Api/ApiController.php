<?php

namespace CommunityAnalytics\Controllers\Api;

use Azuriom\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    /**
     * Show the plugin API default page.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json('Hello World!');
    }
}
