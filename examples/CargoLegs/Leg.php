<?php declare(strict_types=1);

namespace Examples\DCSG\ImmutableCollections\CargoLegs;

final class Leg
{
    /** @var string */
    private $from;

    /** @var string */
    private $to;

    /** @var float */
    private $distance;

    public function __construct(string $from, string $to, float $distance)
    {
        $this->from = $from;
        $this->to = $to;
        $this->distance = $distance;
    }

    public function from(): string
    {
        return $this->from;
    }

    public function to(): string
    {
        return $this->to;
    }

    /**
     * @return float
     */
    public function distance(): float
    {
        return $this->distance;
    }

    public function __toString(): string
    {
        return "From: {$this->from()}\tTo: {$this->to()}\tDistance: {$this->distance()}";
    }
}
