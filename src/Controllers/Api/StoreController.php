<?php

namespace Azuriom\Plugin\CommunityAnalytics\Controllers\Api;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\CommunityAnalytics\Requests\StorePaymentRequest;
use Azuriom\Plugin\CommunityAnalytics\Util\ModelFormatter;
use Azuriom\Plugin\Shop\Models\Package;
use Azuriom\Plugin\Shop\Models\Payment;
use Illuminate\Http\JsonResponse;

class StoreController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function info(): JsonResponse
    {
        return response()->json([]);
    }

    // Packages

    /**
     * @return JsonResponse
     */
    public function packages(): JsonResponse
    {
        $paginate_packages = Package::query()->paginate();
        $packages = [];
        foreach ($paginate_packages->items() as $package) {
            $packages[] = ModelFormatter::formatPackage($package);
        }

        return response()->json([
            'data' => $packages,
            'current_page' => $paginate_packages->currentPage(),
            'last_page' => $paginate_packages->lastPage(),
            'per_page' => $paginate_packages->perPage(),
            'total' => $paginate_packages->total(),
        ]);
    }

    /**
     * @param StorePaymentRequest $request
     * @return JsonResponse
     */
    public function payments(StorePaymentRequest $request): JsonResponse
    {
        $query = Payment::query()->with('user')->with('items')
            ->where('status', '=', 'completed');
        if ($request->date_min)
            $query = $query->where('created_at', '>=', $request->date_min);
        $paginate_payments = $query->paginate();

        $payments = [];
        foreach ($paginate_payments as $payment) {
            $payments[] = ModelFormatter::formatPayment($payment);
        }

        return response()->json([
            'data' => $payments,
            'current_page' => $paginate_payments->currentPage(),
            'last_page' => $paginate_payments->lastPage(),
            'per_page' => $paginate_payments->perPage(),
            'total' => $paginate_payments->total(),
        ]);
    }
}
