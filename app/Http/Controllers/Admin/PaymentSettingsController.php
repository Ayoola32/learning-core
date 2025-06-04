<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PaymentSettingsController extends Controller
{
    public function index(): View
    {
        return view('admin.payment-settings.index');
    }

    public function paypalSettings(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'paypal_mode' => ['required', 'string', 'in:live,sandbox'],
            'paypal_currency' => ['required', 'string'],
            'paypal_rate' => ['required', 'numeric'],
            'paypal_client_id' => ['required'],
            'paypal_client_secret' => ['required'],
            'paypal_app_id' => ['required'],
            'paypal_sandbox_secret' => ['nullable'],
            'paypal_sandbox_client_id' => ['nullable'],
        ]);

        foreach ($validatedData as $key => $value) {
            PaymentSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        };

        Cache::forget('payment_gateway_settings');

        // redirect to relevant page with  notyf success message
        return redirect()->back()->with('success', 'Payment settings updated successfully.');
    }

    // Stripe Settings
    public function stripeSettings(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'stripe_status' => ['required', 'string', 'in:active,inactive'],
            'stripe_currency' => ['required', 'string'],
            'stripe_rate' => ['required', 'numeric'],
            'stripe_publishable_key' => ['required', 'string'],
            'stripe_secret' => ['required'],
        ]);
        // Update or create the payment settings
        foreach ($validatedData as $key => $value) {
            PaymentSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );  
        };

        Cache::forget('payment_gateway_settings');

        // redirect to relevant page with notyf success message
        notyf()->success('Stripe Payment Settings Updated Successfully.');
        return redirect()->back();
    }
}