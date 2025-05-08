<?php

require_once __DIR__.'/../vendor/autoload.php';

use KHQR\BakongKHQR;
use KHQR\Helpers\KHQRData;
use KHQR\Models\IndividualInfo;
use KHQR\Models\MerchantInfo;
use KHQR\Models\SourceInfo;

// Generate KHQR for an individual
$individualInfo = new IndividualInfo(
    'jonhsmith@nbcq',
    'Jonh Smith',
    'PHNOM PENH',
    KHQRData::CURRENCY_KHR,
    500
);

var_dump(BakongKHQR::generateIndividual($individualInfo));

// Generate KHQR for a merchant
$merchantInfo = new MerchantInfo(
    'jonhsmith@nbcq',
    'Jonh Smith',
    'Siem Reap',
    '123456',
    'Dev Bank',
    null,
    null,
    0.0,
    '85512345678'
);

var_dump(BakongKHQR::generateMerchant($merchantInfo));

// Decode a KHQR string
$result = BakongKHQR::decode('00020101021229190015john_smith@devb52045999530311654065000.05802KH5910jonh smith6010Phnom Penh62360109#INV-20030313Coffee Klaing0702#299170013161302797275763049ACF');
var_dump($result);

// Verify a KHQR
$result = BakongKHQR::verify('00020101021229180014jonhsmith@nbcq520459995303116540750000.05802KH5910Jonh Smith6010Phnom Penh62150211855123456789917001316257134678276304A96B');
var_dump($result);

// API - Generate KHQR with Deep Link
$sourceInfo = new SourceInfo(
    'https://bakong.nbc.gov.kh/images/logo.svg',
    'Bakong',
    'https://bakong.nbc.gov.kh'
);
$result = BakongKHQR::generateDeepLink('00020101021229190015john_smith@devb5204599953038405405100.05802KH5910John Smith6010Phnom Penh6304BF30', $sourceInfo);
var_dump($result);

// API - Check Bakong Account Existence
$result = BakongKHQR::checkBakongAccount('dave@devb');
var_dump($result);

// API - Renew Bakong API Token
$result = BakongKHQR::renewToken('john.smith@gmail.com');
var_dump($result);

// API - Check Transaction Status
$bakongKhqr = new BakongKHQR('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjp7ImlkIjoiZGJmYTRkMmI4ZTJmNGM3ZCJ9LCJpYXQiOjE3Mzk0MDQwMTUsImV4cCI6MTc0NzE4MDAxNX0.43qEmjlvz7L9oBCz783JC4psUp4Bw6M9QCPdqbSp8sM');

$response = $bakongKhqr->checkTransactionByMD5('d60f3db96913029a2af979a1662c1e72', true);
var_dump($response);

$response = $bakongKhqr->checkTransactionByFullHash('dcd53430d3b3005d9cda36f1fe8dedc3714ccf18f886cf5d090d36fee67ef956', true);
var_dump($response);

$response = $bakongKhqr->checkTransactionByShortHash('8465d722', 1.0, 'USD', true);
var_dump($response);

$response = $bakongKhqr->checkTransactionByInstructionReference('00001234', true);
var_dump($response);

$response = $bakongKhqr->checkTransactionByExternalReference('DEV123456ZTH', true);
var_dump($response);

$response = $bakongKhqr->checkTransactionByMD5List([
    '0dbe08d3829a8b6b59844e51aa38a4e2',
    '7b0e5c36486d7155eb3ee94997fe9bfb',
    'e12b3ecc4c066405ce05cd8cacab884c',
], true);
var_dump($response);

$response = $bakongKhqr->checkTransactionByFullHashList([
    'f0ae142842181535e678900bc5be1c3bd48d567ced77410a169fb672792968c8',
    'd3b42e35d618a42b7506a79564083e6e91d5383b63f8aa2cf2ca7e65d55ec858',
    '9036688e95cb3d1b621a9a989ebe64629d8c118654cfbc47f4d4991d72fc3b44',
], true);
var_dump($response);
