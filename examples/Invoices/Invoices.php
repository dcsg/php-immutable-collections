<?php declare(strict_types=1);

namespace Examples\DCSG\ImmutableCollections\Invoices;

use InvalidArgumentException;
use DCSG\ImmutableCollections\SetImmutableCollection;

/**
 * @method Invoice first()
 * @method Invoice last()
 * @method Invoice head()
 * @method Invoice[] getIterator(): CollectionIterator
 */
final class Invoices extends SetImmutableCollection
{
    public function totalExcludingVAT()
    {
        return $this->reduce(function (?float $total, Invoice $invoice): float {
            return $total + $invoice->totalExcludingVAT();
        });
    }

    public function totalIncludingVAT()
    {
        return $this->reduce(function (?float $total, Invoice $invoice): float {
            return $total + $invoice->totalIncludingVAT();
        });
    }

    public function countPaidInvoices(): int
    {
        return $this->allPaidInvoices()->count();
    }

    public function allPaidInvoices(): Invoices
    {
        return $this->filter(function (Invoice $invoice) {
            return $invoice->isPaid();
        });
    }

    public function countOutstandingInvoices(): int
    {
        return $this->allOutstandingInvoices()->count();
    }

    public function allOutstandingInvoices(): Invoices
    {
        return $this->filter(function (Invoice $invoice) {
            return !$invoice->isPaid();
        });
    }

    public function printLog(): void
    {
        foreach ($this as $invoice) {
            echo "$invoice\n";
        }
    }

    protected function validateItems(array $elements): void
    {
        foreach ($elements as $element) {
            if (!$element instanceof Invoice) {
                throw new InvalidArgumentException('Element is not an Invoice.');
            }
        }
    }
}
