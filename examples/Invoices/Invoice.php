<?php declare(strict_types=1);

namespace Examples\DCSG\ImmutableCollections\Invoices;

final class Invoice
{
    /** @var string */
    private $id;
    /** @var int */
    private $number;
    /** @var int */
    private $year;
    /** @var InvoiceItems */
    private $items;
    /** @var bool */
    private $paid;

    public function __construct(string $id, int $number, int $year, InvoiceItems $items)
    {
        $this->id = $id;
        $this->number = $number;
        $this->year = $year;
        $this->items = $items;
        $this->paid = false;
    }

    public function pay(): void
    {
        $this->paid = true;
    }

    public function isPaid(): bool
    {
        return $this->paid;
    }

    public function totalIncludingVAT(): float
    {
        return $this->items()->totalIncludingVAT();
    }

    public function items(): InvoiceItems
    {
        return $this->items;
    }

    public function totalExcludingVAT(): float
    {
        return $this->items()->totalExcludingVAT();
    }

    public function __toString(): string
    {
        $paid = $this->isPaid() ? 'Yes' : 'No';

        return "Invoice # {$this->number}/{$this->year}\tPaid: {$paid}\tTotal excl. VAT: {$this->totalExcludingVAT()}\tTotal incl. VAT: {$this->totalIncludingVAT()}";
    }
}
