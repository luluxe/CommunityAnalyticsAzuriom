<?php

namespace Azuriom\Plugin\CommunityAnalytics\Middleware;

use Azuriom\Plugin\CommunityAnalytics\Manager\ApiKeyManager;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticatePluginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check Request
        $api_key = $request->header('X-Community-Analytics-Token');
        if ($api_key == null) {
            return response()->json(['message' => 'Missing header X-Community-Analytics-Token'], 403);
        }

        // Check api_key
        if (ApiKeyManager::getApiKey() != $api_key) {
            return response()->json(['message' => 'Invalid API Token'], 403);
        }

        return $next($request);
    }
}
