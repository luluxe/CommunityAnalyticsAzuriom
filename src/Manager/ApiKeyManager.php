<?php

namespace Azuriom\Plugin\CommunityAnalytics\Manager;

use Azuriom\Models\Setting;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class ApiKeyManager
{
    /**
     * Get actual api token and generate it if not exist.
     *
     * @return string
     */
    public static function getApiKey(): string
    {
        $api_key = Setting::query()->where('name', 'communityanalytics.api-token')->first();
        if ($api_key != null) {
            return Crypt::decryptString($api_key->value);
        }
        return self::regenerateApiKey();
    }

    /**
     * Regenerate new api token and get it.
     *
     * @return string
     */
    public static function regenerateApiKey(): string
    {
        $api_key = Str::random(48);
        Setting::updateSettings([
            'communityanalytics.api-token' => Crypt::encryptString($api_key),
        ]);
        return $api_key;
    }
}
