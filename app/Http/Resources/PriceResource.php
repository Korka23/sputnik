<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Product */
class PriceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $currency = $request->query('currency', 'RUB');
        $price = $this->price;

        $currencyRates = [
            'RUB' => 1,
            'USD' => 90,
            'EUR' => 100,
        ];

        $convertedPrice = $price / ($currencyRates[$currency] ?? 1);

        $formattedPrice = match ($currency) {
            'USD' => '$' . number_format($convertedPrice, 2),
            'EUR' => '€' . number_format($convertedPrice, 2),
            'RUB' => number_format($convertedPrice, 0, '.', ' ') . ' ₽',
            default => number_format($convertedPrice, 2) . ' ' . $currency,
        };
        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => $formattedPrice
        ];
    }
}
