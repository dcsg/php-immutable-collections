<?php declare(strict_types=1);

namespace Examples\DCSG\ImmutableCollections\CargoLegs;

use InvalidArgumentException;
use DCSG\ImmutableCollections\ImmutableCollection;

/**
 * @method Leg first()
 * @method Leg last()
 * @method Leg head()
 * @method Leg[] getIterator(): CollectionIterator
 */
final class Legs extends ImmutableCollection
{
    public function from(string $location): Legs
    {
        return $this->filter(function (Leg $leg) use ($location) {
            return $leg->from() === $location;
        });
    }

    public function to(string $location): Legs
    {
        return $this->filter(function (Leg $leg) use ($location) {
            return $leg->to() === $location;
        });
    }

    public function totalDistance(): float
    {
        return (float)$this->reduce(function (?float $total, Leg $leg): float {
            return $total + $leg->distance();
        });
    }

    public function printLog(): void
    {
        foreach ($this as $leg) {
            echo "{$leg}\n";
        }
    }

    /**
     * @param Leg[] $legs
     */
    protected function validateItems(array $legs): void
    {
        foreach ($legs as $leg) {
            if (!$leg instanceof Leg) {
                throw new InvalidArgumentException('Element is not an instance of Leg');
            }
        }
    }
}
