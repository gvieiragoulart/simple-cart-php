<?php

namespace App\Http\Services\Product;

use App\Models\Products;
use Domain\Product\ProductEntity;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface
{
    public function create(ProductEntity $product): Products;
    public function getAll(): array;
}
