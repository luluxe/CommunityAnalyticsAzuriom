<?php

namespace Azuriom\Plugin\CommunityAnalytics\Controllers\Admin;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\CommunityAnalytics\Manager\ApiKeyManager;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        return view('communityanalytics::admin.index', [
            'api_key' => ApiKeyManager::getApiKey(),
        ]);
    }

    /**
     * @return RedirectResponse
     */
    public function regenerateApiKey(): RedirectResponse
    {
        ApiKeyManager::regenerateApiKey();
        return redirect()->route('communityanalytics.admin.index')
            ->with('success', trans('communityanalytics::main.success.regenerate-api-key'));
    }
}
