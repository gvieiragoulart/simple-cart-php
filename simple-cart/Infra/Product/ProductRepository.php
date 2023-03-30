<?php

namespace Infra\Product;

use App\Http\Services\Product\ProductRepositoryInterface;
use App\Models\Products;
use Domain\Product\ProductEntity;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository implements ProductRepositoryInterface
{
    public function create(ProductEntity $product): Products
    {
        return Products::create(get_object_vars($product));
    }

    public function getAll(): array
    {
        return Products::paginate(15)->toArray();
    }

    public function getById(int $id): ?Products
    {
        return Products::find($id);
    }

    public function deleteById(int $id): void
    {
        Products::find($id)->delete();
    }

    public function editById(array $data, int $id): Products
    {
        $product = Products::find($id);

        $product->update($data);

        return $product;
    }
}