<?php

require __DIR__ . '/vendor/autoload.php';

use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;

$config = new Configuration();
$config->cloud->cloudName = 'test';
$config->cloud->apiKey = 'test';
$config->cloud->apiSecret = 'test';

$uploadApi = new UploadApi($config);
$cloudConfig = $uploadApi->getCloud();

print_r($cloudConfig->cloudName);
