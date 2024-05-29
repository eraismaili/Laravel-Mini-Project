<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalController extends Controller
{
    private $paypal;

    public function __construct()
    {
        $this->paypal = new PayPalClient;
        $this->paypal->setApiCredentials(config('paypal'));
        $this->paypal->setAccessToken($this->paypal->getAccessToken());
    }

    public function payWithPayPal()
    {
        $response = $this->paypal->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => "100.00"
                    ]
                ]
            ],
            "application_context" => [
                "cancel_url" => route('paypal.status'),
                "return_url" => route('paypal.status'),
            ]
        ]);

        if (isset($response['id'])) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        }

        return redirect()
            ->route('paypal.status')
            ->with('error', 'Something went wrong.');
    }

    public function payPalStatus(Request $request)
    {
        $response = $this->paypal->capturePaymentOrder($request->get('token'));

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            return redirect()
                ->route('paypal.pay')
                ->with('success', 'Payment successful.');
        }


        return redirect()
            ->route('paypal.pay')
            ->with('error', 'Payment failed.');
    }
}
