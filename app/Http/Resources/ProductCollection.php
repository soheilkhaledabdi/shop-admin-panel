<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $productsData = $this->collection->map(function ($likeProduct) {
            $product = $likeProduct->product;
            return [
                'id' => $product->id,
                'title' => $product->title,
                'description' => $product->description,
                'price' => $product->price,
                'image' => $product->image,
                'likes' => 10,
                'isLike' => true,
                'rate' => 3.5,
            ];
        });

        return $productsData->toArray();
    }
}
