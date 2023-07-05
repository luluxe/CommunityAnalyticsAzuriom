<?php

namespace CommunityAnalytics\Jobs;

use Azuriom\Plugin\Shop\Models\Package;
use Azuriom\Plugin\Shop\Models\Payment;
use CommunityAnalytics\Util\CommunityAnalyticsUrl;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Schema;

class SendStoreInfoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $api_token;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $api_token)
    {
        $this->api_token = $api_token;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Verify tables exist
        if (!Schema::hasTable('shop_payments') || !Schema::hasTable('shop_packages') || !Schema::hasTable('shop_payment_items')) {
            //TODO : handle error
            return;
        }

        //Create Store in CommunityAnalytics
        $result = $this->createStore();
        if (!$result) {
            return;
            //TODO : handle error
        }

        //Send packages to CommunityAnalytics
        $result = $this->sendPackages();
        if (!$result) {
            return;
            //TODO : handle error
        }
        //Send payments to CommunityAnalytics
        $result= $this->sendPayments();
        if (!$result) {
            return;
            //TODO : handle error
        }
    }

    /**
     * Sync payments with CommunityAnalytics
     * @return bool true if sync is successful, false otherwise
     */
    private function sendPackages(): bool
    {
        $headers = array(
            'Content-Type: application/json',
            'X-Community-Analytics-Token: ' . $this->api_token,
        );
        $packages = Package::query()->get();
        $url = CommunityAnalyticsUrl::Url('packages');


        for ($i = 0; $i < count($packages); $i += 100) {
            $page = $packages->slice($i, 100);

            //Format packages to send to CommunityAnalytics
            $formatted_packages = $this->formatPackages($page);

            // HTTP Request options
            $options = array(
                'http' => array(
                    'header' => $headers,
                    'method' => 'POST',
                    'content' => json_encode($formatted_packages),
                ),
            );

            // Create context stream
            $context = stream_context_create($options);


            try {
                file_get_contents($url, false, $context);
            } catch (Exception $e) {
                return false;
            }
        }
        return true;
    }

    /**
     * Format packages to send to CommunityAnalytics
     *
     * @param $packages Collection|array of packages
     * @return array formatted packages
     */
    private function formatPackages(Collection|array $packages): array
    {
        $formatted_packages = [];
        foreach ($packages as $package) {
            $formatted_packages[] = [
                'id' => $package->id,
                'name' => $package->name,
                'image' => url('/storage/packages/' . $package->image),
                'price' => $package->price,
            ];
        }
        return ['packages' => $formatted_packages];
    }

    /**
     * Sync payments to CommunityAnalytics
     *
     * @returns bool true if sync success, false otherwise
     */
    private function sendPayments(): bool
    {
        $headers = array(
            'Content-Type: application/json',
            'X-Community-Analytics-Token: ' . $this->api_token,
        );
        $url = CommunityAnalyticsUrl::Url('payments');

        // Get all payments
        $payments = Payment::query()->with('user')->with('items')->where('status', '=', 'completed')->get();
        for ($i = 0; $i < count($payments); $i += 100) {
            $page = $payments->slice($i, 100);

            //Format payments to send to CommunityAnalytics
            $formatted_payments = $this->formatPayments($page);

            // HTTP Request options
            $options = array(
                'http' => array(
                    'header' => $headers,
                    'method' => 'POST',
                    'content' =>json_encode($formatted_payments),
                ),
            );

            // Create context stream
            $context = stream_context_create($options);


            try {
                file_get_contents($url, false, $context);
            } catch (Exception $e) {
                return false;
            }
        }
        return true;
    }

    /**
     * Format payments to send to CommunityAnalytics
     * @param Collection|array $page of payments
     * @return array of payments formatted
     */
    private function formatPayments(Collection|array $page): array
    {
        $formatted_payments = [];
        foreach ($page as $payment) {
            $formatted_payments[] = [
                'id' => $payment->id,
                'uuid' => $payment->user->game_id,
                'name' => $payment->user->name,
                'amount' => $payment->price,
                'date' => $payment->created_at,
                'packages' => $this->formatPackagesBought($payment->items),
            ];
        }
        return ['payments' => $formatted_payments];
    }

    /**
     * Format packages bought to send to CommunityAnalytics
     * @param Collection|array $items of packages bought
     * @return array of packages bought formatted
     */
    private function formatPackagesBought(Collection|array $items) : array
    {
        $formatted_items = [];
        foreach ($items as $item) {
            $formatted_items[] = [
                'package_id' => $item->buyable_id,
                'package_name' => $item->name,
                'quantity' => $item->quantity,
                'price' => $item->price,
            ];
        }
        return $formatted_items;
    }

    private function createStore(): bool
    {
        $headers = array(
            'Content-Type: application/json',
            'X-Community-Analytics-Token: ' . $this->api_token,
        );
        $url = CommunityAnalyticsUrl::Url('stores');

        // HTTP Request options
        $options = array(
            'http' => array(
                'header' => $headers,
                'method' => 'POST',
                'content' => json_encode([
                    'store_type' => 'azuriom',
                    'url' => url('/')
                ]),
            ),
        );

        // Create context stream
        $context = stream_context_create($options);

        try {
            file_get_contents($url, false, $context);
        } catch (Exception $e) {
            return false;
        }
        return true;
    }


}
