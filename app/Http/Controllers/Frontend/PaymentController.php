<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Service\OrderService;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Stripe;

class PaymentController extends Controller
{

    /**
     * Get the PayPal configuration settings.
     *
     * @return array
     */
    public function paypalConfig(): array
    {
        return [
            'mode'    => config('payment_gateway.paypal_mode', 'sandbox'), // Can be 'sandbox' or 'live'
            'sandbox' => [
                'client_id'         => config('payment_gateway.paypal_client_id'),
                'client_secret'     => config('payment_gateway.paypal_client_secret'),
                'app_id'            => 'APP-80W284485P519543T',
            ],
            'live' => [
                'client_id'         => config('payment_gateway.paypal_client_id'),
                'client_secret'     => config('payment_gateway.paypal_client_secret'),
                'app_id'            => config('payment_gateway.paypal_app_id'),
            ],

            'payment_action' => env('PAYPAL_PAYMENT_ACTION', 'Sale'),
            'currency'       => config('payment_gateway.paypal_currency', 'USD'),
            'notify_url'     => env('PAYPAL_NOTIFY_URL', ''),
            'locale'         => env('PAYPAL_LOCALE', 'en_US'),
            'validate_ssl'   => env('PAYPAL_VALIDATE_SSL', true),
        ];
    }


    /**
     * Handle the incoming request for PayPal payment.
     */
    public function paypalPayment(Request $request)
    {
        $provider = new PayPalClient($this->paypalConfig());
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
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                } elseif ($link['rel'] === 'self') {
                } elseif ($link['rel'] === 'update') {
                } elseif ($link['rel'] === 'capture') {
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
        $provider = new PayPalClient($this->paypalConfig());
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);
        if (isset($response['status']) && $response['status'] === 'COMPLETED') {
            $capture = $response['purchase_units'][0]['payments']['captures'][0];
            $transactionId = $capture['id'];
            $currency = $capture['amount']['currency_code'];
            $paidAmount = $capture['amount']['value'];

            try {
                // Store the order in the database
                OrderService::storeOrder(
                    $transactionId,
                    auth()->user()->id,
                    'completed',
                    $paidAmount,   // cartTotal(),
                    $paidAmount,
                    $currency,
                    'paypal'
                );
                // Redirect to success page
                return view('frontend.pages.cart.order-success')->with([
                    'transactionId' => $transactionId,
                    'paidAmount' => $paidAmount,
                    'currency' => $currency,
                ]);
            } catch (\Exception $e) {
                throw $e;
            }
        } else {
            return view('frontend.pages.cart.order-failed');
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




    // Stripe MEthods
    public function stripePayment()
    {
        Stripe::setApiKey(config('payment_gateway.stripe_secret'));

        $payableAmount = (cartTotal() * 50);
        $quantityCount = cartItemsCount();

        $response = StripeSession::create([
            'line_items' => [
                [
                    'price_data' => [
                            'currency' => config('payment_gateway.stripe_currency'),
                            'product_data' => [
                            'name' => 'Course',
                        ],
                        'unit_amount' => $payableAmount
                    ],
                    'quantity' => $quantityCount
                ]
            ],
            'mode' => 'payment',
            'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('stripe.cancel')
        ]);

        return redirect()->away($response->url);
    }
}
