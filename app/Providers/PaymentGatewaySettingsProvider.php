<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PaymentGatewaySettingsProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register the payment gateway settings service
        $this->app->singleton('payment_gateway_settings', function ($app) {
            return new \App\Service\PaymentGatewaySetttingsService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Load the payment gateway settings into the config
        $settingsService = $this->app->make('payment_gateway_settings');
        $settingsService->globalSettings();
    }
}
