<?php

namespace DCSG\ImmutableCollections;

use Iterator;

/**
 * @author Daniel Gomes <danielcesargomes@gmail.com>
 */
class CollectionIterator implements Iterator
{
    /** @var array */
    protected $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * Rewind the Iterator to the first element.
     */
    public function rewind(): void
    {
        reset($this->getItems());
    }

    /**
     * We need to return by reference since `next()` requires it.
     */
    private function &getItems(): array
    {
        return $this->items;
    }

    /**
     * Return the current element.
     *
     * @return mixed
     */
    public function current()
    {
        return current($this->getItems());
    }

    /**
     * Return the key of the current element.
     *
     * @return mixed|null scalar on success, or null on failure.
     */
    public function key()
    {
        return key($this->getItems());
    }

    /**
     * Move forward to next element.
     */
    public function next(): void
    {
        next($this->getItems());
    }

    /**
     * Checks if current position is valid.
     */
    public function valid(): bool
    {
        return key($this->getItems()) !== null;
    }
}
