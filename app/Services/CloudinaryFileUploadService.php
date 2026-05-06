<?php

namespace App\Services;

use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Configuration\Configuration;
use Illuminate\Http\UploadedFile;

class CloudinaryFileUploadService
{
    private $uploadApi;
    public function __construct()
    {
        $config = new Configuration();
        $config->cloud->cloudName = env('CLOUDINARY_CLOUD_NAME');
        $config->cloud->apiKey = env('CLOUDINARY_KEY');
        $config->cloud->apiSecret = env('CLOUDINARY_SECRET');
        
        $this->uploadApi = new UploadApi($config);
    }
    
    public function upload(UploadedFile $file, string $folder = 'uploads')
    {
        try {          
            // Upload with SSL verification disabled via cURL options
            $result = $this->uploadApi->upload($file->getRealPath(), [
                'folder' => $folder,
                'resource_type' => 'auto',
                'overwrite' => true,
                'invalidate' => true,
                'curl' => [
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSL_VERIFYHOST => false,
                ]
            ]);

            return $result['secure_url'];
        } catch (\Exception $e) {
            throw new \Exception('Image upload failed: ' . $e->getMessage());
        }
    }

    public function delete(string $url)
    {
        try {
            if(!str_contains($url, 'cloudinary.com')) {
                return false;
            }

            $path = parse_url($url, PHP_URL_PATH);
            $parts = explode('upload/', $path);

            if(count($parts) < 2) {
                return false;
            }

            $afterUpload = $parts[1];
            $segments = explode('/', $afterUpload);

            if(preg_match('/^v\d+$/', $segments[0])) {
                array_shift($segments);
            }

            $publicIdWithExt = implode('/', $segments);
            $publicId = preg_replace('/\.[^.]+$/', '', $publicIdWithExt);

            // The Cloudinary PHP SDK's destroy method ignores HTTP options.
            // We use Laravel's Http client to bypass SSL verification manually.
            $cloudConfig = $this->uploadApi->getCloud();
            $params = [
                'public_id' => $publicId,
                'timestamp' => time(),
            ];
            
            \Cloudinary\Api\ApiUtils::signRequest($params, $cloudConfig);
            
            $response = \Illuminate\Support\Facades\Http::withoutVerifying()
                ->asForm()
                ->post("https://api.cloudinary.com/v1_1/{$cloudConfig->cloudName}/image/destroy", $params);
                
            return $response->json();
        } catch (\Exception $e) {
            throw new \Exception('Image deletion failed: ' . $e->getMessage());
        }
    }
}