<?php

namespace DCSG\ImmutableCollections;

use Closure;

/**
 * @author Daniel Gomes <danielcesargomes@gmail.com>
 */
abstract class ImmutableCollection implements CollectionInterface
{
    /** @var array */
    protected $elements;

    protected function __construct(array $elements)
    {
        $this->validateItems($elements);

        $this->elements = $elements;
    }

    /**
     * Method used to perform type validation for each element.
     * Override it in order to ensure your collection is created with the right type.
     *
     * @param array $elements
     */
    abstract protected function validateItems(array $elements): void;

    /**
     * {@inheritdoc}
     */
    public static function create(array $elements)
    {
        return new static($elements);
    }

    public function getIterator(): CollectionIterator
    {
        return new CollectionIterator($this->getElements());
    }

    protected function getElements(): array
    {
        return $this->elements;
    }

    public function count(): int
    {
        return \count($this->getElements());
    }

    public function isEmpty(): bool
    {
        return $this->getElements() === [];
    }

    /**
     * {@inheritdoc}
     */
    public function last()
    {
        return end($this->elements);
    }

    /**
     * {@inheritdoc}
     */
    public function reverse()
    {
        return new static(\array_reverse($this->toArray()));
    }

    public function toArray(): array
    {
        return $this->elements;
    }

    /**
     * {@inheritdoc}
     */
    public function head()
    {
        return $this->first();
    }

    /**
     * {@inheritdoc}
     */
    public function first()
    {
        return reset($this->elements);
    }

    /**
     * {@inheritdoc}
     */
    public function tail()
    {
        return $this->slice(1);
    }

    /**
     * {@inheritdoc}
     */
    public function slice(int $offset, ?int $length = null)
    {
        return new static(\array_slice($this->getElements(), $offset, $length));
    }

    /**
     * {@inheritdoc}
     */
    public function merge(CollectionInterface $that)
    {
        return new static($this->mergeInternal($that));
    }

    /**
     * Internal method to merge both Collections.
     *
     * @param CollectionInterface $that
     * @return array
     */
    protected function mergeInternal(CollectionInterface $that): array
    {
        $elements = [];
        foreach ($this as $element) {
            $elements[] = $element;
        }

        foreach ($that as $element) {
            $elements[] = $element;
        }

        return $elements;
    }

    /**
     * {@inheritdoc}
     */
    public function map(Closure $closure)
    {
        return new static(\array_map($closure, $this->getElements()));
    }

    /**
     * {@inheritdoc}
     */
    public function filter(Closure $closure)
    {
        return new static(\array_filter($this->getElements(), $closure));
    }

    /**
     * {@inheritdoc}
     */
    public function reduce(Closure $closure)
    {
        return \array_reduce($this->getElements(), $closure);
    }

    /**
     * {@inheritdoc}
     */
    public function get($element)
    {
        if ($this->contains($element)) {
            $key = \array_search($element, $this->getElements(), true);

            return $this->getElements()[$key];
        }

        throw new NotFoundException('Element not found.');
    }

    /**
     * {@inheritdoc}
     */
    public function contains($element): bool
    {
        return \in_array($element, $this->getElements(), true);
    }
}
