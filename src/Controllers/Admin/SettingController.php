<?php

namespace CommunityAnalytics\Controllers\Admin;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Models\Setting;
use CommunityAnalytics\Jobs\SendStoreInfoJob;
use CommunityAnalytics\Requests\ApiTokenStoreRequest;
use CommunityAnalytics\Util\CommunityAnalyticsUrl;
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
        $api_key = Setting::firstWhere('name', 'community-analytics.api_token');

        return view('community-analytics::admin.settings', [
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
        $url = CommunityAnalyticsUrl::Url('platform');

        //Check api_token
        $headers = array(
            'X-Community-Analytics-Token: ' . $api_token,
        );
        try {
            $response = file_get_contents($url, false, stream_context_create([
                'http' => [
                    'method' => 'POST',
                    'header' => $headers,
                ],
            ]));
        } catch (Exception $e) {
            return redirect()->route('community-analytics.admin.settings')
                ->with('error', 'Invalid api_token');
        }

        //Save the api_token
        Setting::updateSettings([
            'community-analytics.api_token' => $request->api_token,
        ]);

        //Launch sync job
        SendStoreInfoJob::dispatch($request->api_token);

        return redirect()->route('community-analytics.admin.settings')
            ->with('success', trans('community-analytics::admin.settings.apiTokenStored') );
    }
}
