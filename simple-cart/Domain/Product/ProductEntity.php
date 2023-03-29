<?php
namespace Domain\Product;

class ProductEntity {
    public string $title;
    public float $price;
    public ?string $description;

    public function __construct(array $data)
    {
        $this->title        = $data['title'];
        $this->price        = $data['price'];
        $this->description  = $data['description'] ?? null;
    }
}