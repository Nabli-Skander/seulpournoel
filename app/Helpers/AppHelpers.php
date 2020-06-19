<?php

namespace App\Helpers;

use Stripe\Charge;
use Stripe\Customer;

class AppHelpers
{
    public static function charge($request, $amount, $currency = 'eur')
    {
        $customer = Customer::create(array(
          'email' => $request->stripeEmail,
          'source' => $request->stripeToken
        ));

        $charge = Charge::create(array(
          'customer' => $customer->id,
          'amount' => $amount,
          'currency' => $currency
        ));

    }
}