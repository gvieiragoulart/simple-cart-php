<?php
namespace Domain\Product;

class ProductEntity {
    public string $title;
    public float $price;
    public ?string $description;
    public int $quantity;

    public function __construct(array $data)
    {
        $this->title        = $data['title'];
        $this->price        = $data['price'];
        $this->description  = $data['description'] ?? null;
        $this->quantity     = $data['quantity'];
    }
}