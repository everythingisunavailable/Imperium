<?php

//TO DO: check the request body if the request if from the cart or from buy now.
//fill the checkout session with products

require_once '../vendor/autoload.php';
require_once '../config/checkout.config.php';

\Stripe\Stripe::setApiKey($stripeSecretKey);
header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost/imperium/public';

$checkout_session = \Stripe\Checkout\Session::create([
  'line_items' => [[

    'price_data' => [
      'currency' => 'eur',
      'unit_amount' => '1000', //equals to 10 euros
      'product_data' => [
        'name' => 'farts', //name
      ]
    ],
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . '/',
  'cancel_url' => $YOUR_DOMAIN . '/',// to do: redirect to product page
]);

header("Location: " . $checkout_session->url);