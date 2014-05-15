<?php

return array(
    'storage' => 'cache', //session, cache

    // Cache
    // Laravel documentation for more information
    'cache_prefix' => 'moltin_cart_',
    'cache_expire' => '10080', //in minutes, -1  permanent caching

    // Identifier
    // With a requestcookie (choose for storage: cache, the session will be expired), the cart could be reloaded from a http request, example: the customer could save his cart link (email, hyperlink) and reopen this later.
    // If there is no request, the cookie will be loaded.
    'identifier' => 'requestcookie', //cookie, requestcookie

    //Request Cookie
    'requestid' => 'CartID', //http input request identifier, example: your customer/backoffice could reload the cart in your shop controller, /public/shop?CartID=871f0bc18ca76e68bf7c3adf8f9426ef
);