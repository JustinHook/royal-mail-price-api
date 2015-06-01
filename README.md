Royal Mail Price API
===========================
This repository allows you to host your own Royal Mail price API.
It is a HTTP wrapper around the PHP library https://github.com/JustinHook/royal-mail-price-calculator, that returns prices in JSON format.

Usage
-----
You can either run the API with Docker using the prebuilt image at https://registry.hub.docker.com/u/justinhook/royal-mail-price-api/ or you can serve the code in this repository with a web server.

#### 1. Download
The easiest way to download the API is with `git`:

    $ git clone https://github.com/JustinHook/royal-mail-price-api.git
    
#### 2. Install dependencies
We use composer to manage our dependencies. You can download it from https://getcomposer.org/.

    $ cd royal-mail-price-api
    $ composer install

#### 3. Finish
You should now be able to access the below URL in your browser.

    /index.php?length=10&width=10&depth=2&services=signedforsecondclass,secondclass

The following JSON data should be returned.

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

Parameters
-----

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
