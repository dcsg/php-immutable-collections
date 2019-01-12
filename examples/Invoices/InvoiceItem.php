<?php

namespace Examples\DCSG\ImmutableCollections\Invoices;

final class InvoiceItem
{
    private $id;
    private $name;
    private $price;
    private $vat;
    private $quantity;

    public function __construct(string $id, string $name, float $price, float $vat, int $quantity)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->vat = $vat;
        $this->quantity = $quantity;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function totalExcludingVAT(): float
    {
        return $this->price() * $this->quantity();
    }

    public function price(): float
    {
        return $this->price;
    }

    public function quantity(): int
    {
        return $this->quantity;
    }

    public function totalIncludingVAT(): float
    {
        return $this->price() * (1 + $this->vat()) * $this->quantity();
    }

    public function vat(): float
    {
        return $this->vat;
    }
}
