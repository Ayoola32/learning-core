<?php

namespace App\Service;

use App\Models\PaymentSetting;
use Illuminate\Support\Facades\Cache;

class PaymentGatewaySetttingsService
{

    /**
     * Get the payment gateway settings from the cache or database.
     *
     * @return array|null
     */
    public function getSettings(): ? array
    {
        return Cache::rememberForever('payment_gateway_settings', function () {
                return PaymentSetting::all()->pluck('value', 'key')->toArray();
            }
        );
    }


    /**
     * Get the payment gateway settings and set them in the config.
     *
     */
    public function globalSettings()
    {
        $settings = $this->getSettings();
        config()->set('payment_gateway', $settings);
    }


}
