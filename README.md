Royal Mail Price API
===========================
This repository allows you to host your own Royal Mail price API.
It is a HTTP wrapper around the PHP library https://github.com/JustinHook/royal-mail-price-calculator, that returns prices in JSON format.

Usage
-----
Run `composer install`

`GET /index.php?length=10&width=10&depth=2&services=signedforsecondclass,secondclass`

```json
[
    {
        "service": "Signed For 2nd Class",
        "prices": [
            {
                "price": "1.83",
                "compensation": 50
            }
        ]
    },
    {
        "service": "2nd Class",
        "prices": [
            {
                "price": "0.73",
                "compensation": 20
            }
        ]
    }
]
```

Required Parameters  | Description
------------- | -------------
`length`  | Length of package in centimeters
`width`  | Width of package in centimeters
`depth`  | Depth of package in centimeters
`weight` | Weight of package in grams
`services` | Comma separated list of services

Valid Services | Description
------------- | -------------
`firstclass` | First Class
`secondclass` | Second Class
`signedforfirstclass`  | Signed for First Class
`signedforsecondclass` | Signed for Second Class
`guaranteedby9am` | Guaranteed By 9am
`guaranteedby9amwithsaturday` | Guaranteed By 9am With Saturday
`guaranteedby1pm` | Guaranteed By 1pm
`guaranteedby1pmwithsaturday` | Guaranteed By 1pm With Saturday