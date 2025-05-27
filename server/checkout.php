<?php

//TO DO: check the request body if the request is from the cart or from buy now.
//fill the checkout session with products
//save the products to user session to add them to the database

require_once '../vendor/autoload.php';
require_once '../config/checkout.config.php';

\Stripe\Stripe::setApiKey($stripeSecretKey);
header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost/imperium';

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
  'success_url' => $YOUR_DOMAIN . '/public/',
  'cancel_url' => $YOUR_DOMAIN . '/public/',
    'metadata' => [
      'product_id' => 123, //ids from database  
      'user_id' => 456,
  ],
]);

header("Location: " . $checkout_session->url);