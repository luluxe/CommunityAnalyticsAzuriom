<?php

namespace Azuriom\Plugin\CommunityAnalytics\Controllers\Admin;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Models\Setting;
use Azuriom\Plugin\CommunityAnalytics\Jobs\SendStoreInfoJob;
use Azuriom\Plugin\CommunityAnalytics\Requests\ApiTokenStoreRequest;
use Azuriom\Plugin\CommunityAnalytics\Util\CommunityAnalyticsUtil;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SettingController extends Controller
{
    /**
     * Display the CommunityAnalytics page settings.
     *
     * @return Application|Factory|View
     */
    public function show(): View|Factory|Application
    {
        $api_key = Setting::query()->where('name', 'communityanalytics.api_token')->first();

        return view('communityanalytics::admin.settings', [
            'api_key' => $api_key ? $api_key->value : '',
        ]);
    }

    /**
     * Update the api_token.
     *
     * @param  ApiTokenStoreRequest  $request
     * @return RedirectResponse
     *
     */
    public function save(ApiTokenStoreRequest $request) : RedirectResponse
    {
        $api_token = $request->api_token;
        $url = CommunityAnalyticsUtil::getUrl('platform');

        //Check api_token
        $headers = array(
            'X-communityanalytics-Token: ' . $api_token,
        );
        try {
            $response = file_get_contents($url, false, stream_context_create([
                'http' => [
                    'method' => 'POST',
                    'header' => $headers,
                ],
            ]));
        } catch (Exception $e) {
            return redirect()->route('communityanalytics.admin.settings')
                ->with('error', 'Invalid api_token');
        }

        //Save the api_token
        Setting::updateSettings([
            'communityanalytics.api_token' => $request->api_token,
        ]);

        //Launch sync job
        SendStoreInfoJob::dispatch($request->api_token);

        return redirect()->route('communityanalytics.admin.settings')
            ->with('success', trans('communityanalytics::admin.settings.apiTokenStored') );
    }
}
