<?php

namespace Examples\DCSG\ImmutableCollections\Invoices;

use InvalidArgumentException;
use DCSG\ImmutableCollections\Collection;

/**
 * @method InvoiceItem first()
 * @method InvoiceItem last()
 * @method InvoiceItem head()
 * @method InvoiceItem[] getIterator(): CollectionIterator
 */
final class InvoiceItems extends Collection
{
    public function totalIncludingVAT(): float
    {
        return (float)$this->reduce(function (?float $total, InvoiceItem $item): float {
            return $total + $item->totalIncludingVAT();
        });
    }

    public function totalExcludingVAT(): float
    {
        return (float)$this->reduce(function (?float $total, InvoiceItem $item): float {
            return $total + $item->totalExcludingVAT();
        });
    }

    /**
     * @param InvoiceItem[] $elements
     */
    protected function validateItems(array $elements): void
    {
        foreach ($elements as $element) {
            if (!$element instanceof InvoiceItem) {
                throw new InvalidArgumentException('Element is not a valid InvoiceItem.');
            }
        }
    }
}
