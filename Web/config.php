<?php
require_once('vendor/autoload.php');

$stripe = array(
    "secret_key"      => "sk_test_PgfzrtIBMu934gukCa7nzS3E",
    "publishable_key" => "pk_test_0kIi6FcI4nVpBYIe9bSfWbvB"
);

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>