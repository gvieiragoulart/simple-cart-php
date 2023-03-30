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
    public function getById(int $id): ?Products;
    public function deleteById(int $id): void;
    public function editById(array $data,int $id): Products;
}
