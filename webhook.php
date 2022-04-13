<?php
require 'vendor/autoload.php';
require 'stripe-php-master/init.php';
// Set your secret key. Remember to switch to your live secret key in production.
// See your keys here: https://dashboard.stripe.com/apikeys
\Stripe\Stripe::setApiKey('sk_test_51KnIi8SJj2MOB2CHx2vwMHyzFWRPiUqIlUTukrbXp0qVGFIGmKzRJpGeiik00LeBvEgyuzYxmHYv6TZx2fQMmEdo00vLX3trRV');

// If you are testing your webhook locally with the Stripe CLI you
// can find the endpoint's secret by running `stripe listen`
// Otherwise, find your endpoint's secret in your webhook settings in the Developer Dashboard
$endpoint_secret = 'whsec_pZrL1wW0hqDiwvx6sQr77Fx1ewGQ6q51';

$payload = @file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
$event = null;

echo $event;

try {
    $event = \Stripe\Webhook::constructEvent(
        $payload, $sig_header, $endpoint_secret
    );
} catch(\UnexpectedValueException $e) {
    // Invalid payload
    http_response_code(400);
    exit();
} catch(\Stripe\Exception\SignatureVerificationException $e) {
    // Invalid signature
    http_response_code(400);
    exit();
}

// Handle the event
switch ($event->type) {
    case 'checkout.session.async_payment_failed':
      $session = $event->data->object;
      echo $event;
      break;
    case 'checkout.session.async_payment_succeeded':
      $session = $event->data->object;
      echo $event;
      break;
    case 'checkout.session.completed':
      $session = $event->data->object;
      echo $event;
      break;
    case 'checkout.session.expired':
      $session = $event->data->object;
      echo $event;
      break;
    // ... handle other event types
    default:
      echo 'Received unknown event type ' . $event->type;
      echo $event;
      break;
}

http_response_code(200);