# Bakong KHQR PHP

![tests badge](https://github.com/fidele007/bakong-khqr-php/actions/workflows/tests.yml/badge.svg)

This is a complete implementation of the [`bakong-khqr`](https://www.npmjs.com/package/bakong-khqr) npm module, including all the available API calls documented here: https://api-bakong.nbc.gov.kh/document.

## Installation

```shell
composer require extlib-khqr/bakong-khqr-php
```

## Usage

All available methods are exposed through the `BakongKHQR` class:

### Generate KHQR for an individual

```php
use KHQR\BakongKHQR;
use KHQR\Helpers\KHQRData;
use KHQR\Models\IndividualInfo;

$individualInfo = new IndividualInfo(
    bakongAccountID: 'jonhsmith@nbcq',
    merchantName: 'Jonh Smith',
    merchantCity: 'PHNOM PENH',
    currency: KHQRData::CURRENCY_KHR,
    amount: 500
);

var_dump(BakongKHQR::generateIndividual($individualInfo));
```

Output:

```shell
object(KHQR\Models\KHQRResponse)#15 (2) {
  ["status"]=>
  array(3) {
    ["code"]=>
    int(0)
    ["errorCode"]=>
    NULL
    ["message"]=>
    NULL
  }
  ["data"]=>
  array(2) {
    ["qr"]=>
    string(119) "00020101021229180014jonhsmith@nbcq52045999530311654035005802KH5910Jonh Smith6010PHNOM PENH99170013173949577872263046894"
    ["md5"]=>
    string(32) "b1c250304b8594e4c6b53dd44791b57a"
  }
}
```

### Generate KHQR for a merchant

```php
use KHQR\BakongKHQR;
use KHQR\Models\MerchantInfo;

$merchantInfo = new MerchantInfo(
    bakongAccountID: 'jonhsmith@nbcq',
    merchantName: 'Jonh Smith',
    merchantCity: 'Siem Reap',
    merchantID: '123456',
    acquiringBank: 'Dev Bank',
    mobileNumber: '85512345678',
);

var_dump(BakongKHQR::generateMerchant($merchantInfo));
```

Output:

```shell
object(KHQR\Models\KHQRResponse)#19 (2) {
  ["status"]=>
  array(3) {
    ["code"]=>
    int(0)
    ["errorCode"]=>
    NULL
    ["message"]=>
    NULL
  }
  ["data"]=>
  array(2) {
    ["qr"]=>
    string(152) "00020101021130400014jonhsmith@nbcq01061234560208Dev Bank5204599953031165802KH5910Jonh Smith6009Siem Reap6215021185512345678991700131739495778722630433E1"
    ["md5"]=>
    string(32) "c0d2d74726f8e887f37a585cda3b3a79"
  }
}
```

### Decode KHQR

```php
$result = BakongKHQR::decode('00020101021229190015john_smith@devb52045999530311654065000.05802KH5910jonh smith6010Phnom Penh62360109#INV-20030313Coffee Klaing0702#299170013161302797275763049ACF');

var_dump($result);
```

Output:

```shell
object(KHQR\Models\KHQRResponse)#19 (2) {
  ["status"]=>
  array(3) {
    ["code"]=>
    int(0)
    ["errorCode"]=>
    NULL
    ["message"]=>
    NULL
  }
  ["data"]=>
  array(24) {
    ["merchantType"]=>
    string(2) "29"
    ["bakongAccountID"]=>
    string(15) "john_smith@devb"
    ["accountInformation"]=>
    NULL
    ["merchantID"]=>
    NULL
    ["acquiringBank"]=>
    NULL
    ["billNumber"]=>
    string(9) "#INV-2003"
    ["mobileNumber"]=>
    NULL
    ["storeLabel"]=>
    string(13) "Coffee Klaing"
    ["terminalLabel"]=>
    string(2) "#2"
    ["purposeOfTransaction"]=>
    NULL
    ["languagePreference"]=>
    NULL
    ["merchantNameAlternateLanguage"]=>
    NULL
    ["merchantCityAlternateLanguage"]=>
    NULL
    ["payloadFormatIndicator"]=>
    string(2) "01"
    ["pointofInitiationMethod"]=>
    string(2) "12"
    ["unionPayMerchant"]=>
    NULL
    ["merchantCategoryCode"]=>
    string(4) "5999"
    ["transactionCurrency"]=>
    string(3) "116"
    ["transactionAmount"]=>
    string(6) "5000.0"
    ["countryCode"]=>
    string(2) "KH"
    ["merchantName"]=>
    string(10) "jonh smith"
    ["merchantCity"]=>
    string(10) "Phnom Penh"
    ["timestamp"]=>
    string(17) "00131613027972757"
    ["crc"]=>
    string(4) "9ACF"
  }
}
```

### Verify KHQR

```php
$result = BakongKHQR::verify('00020101021229180014jonhsmith@nbcq520459995303116540750000.05802KH5910Jonh Smith6010Phnom Penh62150211855123456789917001316257134678276304A96B');

var_dump($result);
```

Output:

```shell
object(KHQR\Models\CRCValidation)#16 (1) {
  ["isValid"]=>
  bool(true)
}
```

### API - Generate KHQR with Deep Link

```php
$sourceInfo = new SourceInfo(
    appIconUrl: 'https://bakong.nbc.gov.kh/images/logo.svg',
    appName: 'Bakong',
    appDeepLinkCallback: 'https://bakong.nbc.gov.kh'
);
$result = BakongKHQR::generateDeepLink('00020101021229190015john_smith@devb5204599953038405405100.05802KH5910John Smith6010Phnom Penh6304BF30', $sourceInfo);

var_dump($result);
```

Output:

```shell
object(KHQR\Models\KHQRResponse)#5 (2) {
  ["status"]=>
  array(3) {
    ["code"]=>
    int(0)
    ["errorCode"]=>
    NULL
    ["message"]=>
    NULL
  }
  ["data"]=>
  object(KHQR\Models\KHQRDeepLinkData)#17 (1) {
    ["shortLink"]=>
    string(42) "https://bakong.page.link/yhDhTSdPWschTBdb8"
  }
}
```

### API - Check Bakong Account Existence

```php
$result = BakongKHQR::checkBakongAccount('dave@devb');

var_dump($result);
```

Output:

```shell
object(KHQR\Models\KHQRResponse)#16 (2) {
  ["status"]=>
  array(3) {
    ["code"]=>
    int(0)
    ["errorCode"]=>
    NULL
    ["message"]=>
    NULL
  }
  ["data"]=>
  array(1) {
    ["bakongAccountExists"]=>
    bool(false)
  }
}
```

### API - Check Transaction Status

A valid token is required to check transaction status. You can get one by registering on the Bakong website: https://api-bakong.nbc.gov.kh/register. At the moment of writing this README the token has to be renewed every 90 days. Then you can create a `BakongKHQR` instance with the token:

```php
$bakongKhqr = new BakongKHQR('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...');
```

#### Check Transaction by MD5

```php
$response = $bakongKhqr->checkTransactionByMD5('d60f3db96913029a2af979a1662c1e72');
```

#### Check Transaction by MD5 List

```php
$response = $bakongKhqr->checkTransactionByMD5List([
    '0dbe08d3829a8b6b59844e51aa38a4e2',
    '7b0e5c36486d7155eb3ee94997fe9bfb',
    'e12b3ecc4c066405ce05cd8cacab884c',
]);
```

#### Check Transaction by Full Hash

```php
$response = $bakongKhqr->checkTransactionByFullHash('dcd53430d3b3005d9cda36f1fe8dedc3714ccf18f886cf5d090d36fee67ef956');
```

#### Check Transaction by Full Hash List

```php
$response = $bakongKhqr->checkTransactionByFullHashList([
    'f0ae142842181535e678900bc5be1c3bd48d567ced77410a169fb672792968c8',
    'd3b42e35d618a42b7506a79564083e6e91d5383b63f8aa2cf2ca7e65d55ec858',
    '9036688e95cb3d1b621a9a989ebe64629d8c118654cfbc47f4d4991d72fc3b44',
]);
```

#### Check Transaction by Short Hash

```php
$response = $bakongKhqr->checkTransactionByShortHash('8465d722', 1.0, 'USD');
```

#### Check Transaction by Instruction Reference

```php
$response = $bakongKhqr->checkTransactionByInstructionReference('00001234');
```

#### Check Transaction by External Reference

```php
$response = $bakongKhqr->checkTransactionByExternalReference('DEV123456ZTH');
```

### API - Renewing an expired Bakong API Token

If your token has expired, you will get a `KHQRException` when calling authorized Bakong API requests:

```shell
object(KHQR\Exceptions\KHQRException)#51 (7) {
  ["message":protected]=>
  string(57) "Unauthorized, not yet requested for token or code invalid"
  ["string":"Exception":private]=>
  string(0) ""
  ["code":protected]=>
  int(6)
  ...
}
```

You can renew your token with the `renewToken` method:

```php
$result = BakongKHQR::renewToken('john.smith@gmail.com');

var_dump($result);
```

Output:

```shell
array(4) {
  ["responseCode"]=>
  int(0)
  ["responseMessage"]=>
  string(21) "Token has been issued"
  ["errorCode"]=>
  NULL
  ["data"]=>
  array(1) {
    ["token"]=>
    string(172) "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
  }
}
```

In case your email is not registered:

```shell
array(4) {
  ["responseCode"]=>
  int(1)
  ["responseMessage"]=>
  string(18) "Not registered yet"
  ["errorCode"]=>
  int(10)
  ["data"]=>
  NULL
}
```

## Testing

To run the tests:

```shell
composer run test
```

## Static Code Analysis

To run static code analysis:

```shell
composer run stan
```

## Code Style

To run the code style fixer:

```shell
composer run pint
```

## Code Refactoring

```shell
composer run refactor
```

## Troubleshooting

### PHP curl does not work correctly on Windows.

It may be due to the fact that your PHP configuration does not include a valid certificate file. This can be confirmed by disabling the SSL verification:

```php
// ignore the SSL certificate
curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER,false);
```

or by checking with `phpinfo()`:

```shell
curl.cainfo => no value => no value
```

If that's true, the certificate file can be downloaded from https://curl.se/ca/cacert.pem, and include in `php.ini` file:

```properties
curl.cainfo = "C:\Users\force\cacert.pem"
```

After that, restart your services or your terminal and retest.
