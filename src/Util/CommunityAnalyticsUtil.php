<?php

namespace Azuriom\Plugin\CommunityAnalytics\Util;

class CommunityAnalyticsUtil
{
    /**
     * Get base url of CommunityAnalytics depending on the environment
     * @return string base url of CommunityAnalytics
     */
    public static function getUrl(string $path) : string
    {
        return 'http://communityanalytics.test/api/v1/'.$path;
        // TODO Update before pushing to production
        return 'https://communityanalytics.net/api/v1/'.$path;
    }

}
