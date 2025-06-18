<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexPriceRequest;
use App\Http\Resources\PriceResource;
use App\Models\Product;

class PriceController extends Controller
{
    /**
     * Возвращает продукты с конвертированной  стоимостью
     *
     */
    public function __invoke(IndexPriceRequest $request)
    {
        $request->validated();

        return PriceResource::collection(Product::all());
    }
}