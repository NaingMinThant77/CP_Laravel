<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            'category_id' => $this->category_id,
            "category" => $this->category,
            "name" => $this->name,
            "description" => $this->description,
            "price" => $this->price,
            "image_url" => $this->image_url ? Storage::url($this->image_url) : null,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }
}