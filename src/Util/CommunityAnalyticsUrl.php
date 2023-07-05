<?php

namespace CommunityAnalytics\Util;

class CommunityAnalyticsUrl
{
    /**
     * Get base url of CommunityAnalytics depending on the environment
     * @return string base url of CommunityAnalytics
     */
    public static function Url(string $path) : string
    {
        if (config('app.env') == 'local') {//TODO : remove this when in production
            return 'http://community-analytics.test/api/v1/'.$path;
        }
        return 'https://communityanalytics.net/api/v1/'.$path;
    }

}
