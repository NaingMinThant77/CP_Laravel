<?php

require __DIR__ . '/vendor/autoload.php';

use App\Services\CloudinaryFileUploadService;

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$service = new CloudinaryFileUploadService();

$url = "https://res.cloudinary.com/dgyvgsue4/image/upload/v1778041360/products/ipav2gfwal7edkdwpbdi.png";
echo "URL: " . $url . "\n";
$result = $service->delete($url);
print_r($result);

