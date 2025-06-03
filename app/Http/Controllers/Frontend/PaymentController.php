<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentController extends Controller
{
    /**
     * Handle the incoming request for PayPal payment.
     */
    public function paypalPayment(Request $request)
    {
        $provider = new PayPalClient();
        $provider->getAccessToken();
        $payableAmount = cartTotal();

        $response = $provider->createOrder([
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => config('paypal.currency'),
                        'value' => $payableAmount,
                    ],
                ],
            ],
            'application_context' => [
                'return_url' => route('paypal.success'),
                'cancel_url' => route('paypal.cancel'),
            ],
        ]);

        if (isset($response['id']) && $response['id']) {
            foreach ($response['links'] as $link) {
                if($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }elseif 
                    ($link['rel'] === 'self') {
                }elseif 
                    ($link['rel'] === 'update') {
                }elseif 
                    ($link['rel'] === 'capture') {
                }
            }
        } else {
            // Handle error
            return redirect()->route('cart.index')->with('error', 'Payment failed. Please try again.');
        }
    }

    /**
     * Handle the PayPal success response.
     */
    public function paypalSuccess(Request $request)
    {
        // Logic for handling successful PayPal payment
        $provider = new PayPalClient();
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);
        if (isset($response['status']) && $response['status'] === 'COMPLETED') {
            return redirect()->route('cart.index')->with('success', 'Payment successful!');
        } else {
            return redirect()->route('cart.index')->with('error', 'Payment failed. Please try again.');
        }
    }

    /**
     * Handle the PayPal cancel response.
     */
    public function paypalCancel(Request $request)
    {
        // Logic for handling canceled PayPal payment
        return redirect()->route('cart.index')->with('error', 'Payment canceled.');
    }
}
