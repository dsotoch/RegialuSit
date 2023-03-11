<?php

namespace App\Http\Controllers;

use App\Models\planes;
use Illuminate\Http\Request;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\CreditCard;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\PaymentGateway;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{

    public function checkout(Request $request)
    {

        $licencia = planes::where('nombre_plan', $request->input('licencia'))->first();
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $amount = $licencia->precio;

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.success'),
                "cancel_url" => route('paypal.cancel'),
            ],
            "purchase_units" => [
                0 => [
                    "description" => "Plan : $licencia->nombre_plan",
                    "amount" => [

                        "currency_code" => "USD",
                        "value" => "$amount"
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {

            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return response()->json([$links['href']]);
                }
            }

            return response()->json(['value' => false]);
        } else {
            return response()->json(['value' => false, 'message' => $response['message']]);
        }
    }


    public function success(Request $request)
    {

        $fecha = Carbon::now();
        $user = Auth::user();
        if ($user) {

            return view('cuentas/success', ['fecha' => $fecha, 'user' => $user]);
        }
    }

    public function cancel(Request $request)
    {
        $user = Auth::user();
        $fecha = Carbon::now();
        return view('cuentas/cancel', ['fecha' => $fecha,'user'=>$user]);
    }
    public function ejecutar_pago(Request $request)
    {
        $user = Auth::user();
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->input('token'));

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return response()->json(['value' => $response]);
        } else {
            return response()->json(['value' => false]);
        }
    }
}
