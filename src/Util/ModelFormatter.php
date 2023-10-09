<?php

namespace Azuriom\Plugin\CommunityAnalytics\Util;

use Illuminate\Database\Eloquent\Model;

class ModelFormatter
{
    /**
     * @param Model $package
     * @return array
     */
    public static function formatPackage(Model $package): array
    {
        return [
            'id' => $package->id,
            'name' => $package->name,
            'image' => url('/storage/packages/' . $package->image),
            'price' => $package->price,
        ];
    }

    /**
     * @param Model $payment
     * @return array
     */
    public static function formatPayment(Model $payment): array
    {
        $formatted_items = [];
        foreach ($payment->items as $item) {
            $formatted_items[] = [
                'package_id' => $item->buyable_id,
                'package_name' => $item->name,
                'quantity' => $item->quantity,
                'amount' => $item->price,
            ];
        }

        return [
            'id' => $payment->id,
            'identifier' => $payment->user->game_id,
            'name' => $payment->user->name,
            'amount' => $payment->price,
            'date' => $payment->created_at,
            'packages' => $formatted_items,
        ];
    }
}
