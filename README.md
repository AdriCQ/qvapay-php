# client-php

PHP client for the QvaPay API

## Usage

```php
// Create SDK instance
$qvapay = new \QvaPay\QvaPay();

/**
 * ------------------------------
 * Examples
 * ------------------------------
 */
 
/**
 * Auth Login 
 */
$qvapay->auth()->login([
    'email'=> 'john@doe.com',
    'password'=> 'SuperSecuredPassword'
]);

/**
 * TopUp Balance 
 */
$qvapay->user()->topUpBalance(
    [
        "pay_method"=> "BTCLN",
        "amount"=> 67
    ]
);
```

## Links

[QvaPay Documentation](https://qvapay.com/docs)