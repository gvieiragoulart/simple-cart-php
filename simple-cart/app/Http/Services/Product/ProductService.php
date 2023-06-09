<?php

namespace App\Http\Services\Product;

use App\Models\Products;
use Domain\Product\ProductEntity;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService {
    private ProductRepositoryInterface $productRepositoryInterface;

    public function __construct(ProductRepositoryInterface $productRepositoryInterface)
    {
        $this->productRepositoryInterface    = $productRepositoryInterface;
    }

    public function create(array $data): Products
    {
        $product = new ProductEntity($data);

        return $this->productRepositoryInterface->create($product);
    }

    public function getAll(): array
    {
        return $this->productRepositoryInterface->getAll();
    }

    public function getById(int $id): ?Products
    {
        return $this->productRepositoryInterface->getById($id);
    }

    public function deleteById(int $id): bool
    {
        if($this->getById($id)) {
            $this->productRepositoryInterface->deleteById($id);
            return true;
        }

        return false;
    }

    public function editById(array $data,int $id): Products|bool
    {
        if($this->getById($id)) {
            return $this->productRepositoryInterface->editById($data, $id);
        }

        return false;
    }
}