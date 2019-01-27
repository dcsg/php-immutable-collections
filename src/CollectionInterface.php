<?php declare(strict_types=1);

namespace DCSG\ImmutableCollections;

use Closure;
use Countable;
use IteratorAggregate;

/**
 * @author Daniel Gomes <danielcesargomes@gmail.com>
 */
interface CollectionInterface extends IteratorAggregate, Countable
{
    /**
     * @param array $elements
     * @return static
     */
    public static function create(array $elements);

    public function isEmpty(): bool;

    /**
     * @return mixed
     */
    public function last();

    /**
     * @return static
     */
    public function reverse();

    public function toArray(): array;

    /**
     * @return mixed
     */
    public function head();

    /**
     * @return mixed
     */
    public function first();

    /**
     * @return static
     */
    public function tail();

    /**
     * @param int $offset
     * @param int|null $length
     * @return static
     */
    public function slice(int $offset, ?int $length = null);

    /**
     * @param CollectionInterface $that
     * @return static
     */
    public function merge(CollectionInterface $that);

    /**
     * @param Closure $closure
     * @return static
     */
    public function map(Closure $closure);

    /**
     * @param Closure $closure
     * @return static
     */
    public function filter(Closure $closure);

    /**
     * Iteratively reduce the array to a single value using an anonymous function
     *
     * @param Closure $closure
     * @return mixed|null
     */
    public function reduce(Closure $closure);

    /**
     * Gets the `Element` if it exists in the Collection or Throws NotFoundException if nothing was founded.
     *
     * Override this method if your Objects are more complex or if you need a more specific logic to find the Elements.
     *
     * @param mixed $element
     * @return mixed
     */
    public function get($element);

    /**
     * Returns True if the `Element` exists in the Collection or False if it does not exist.
     *
     * Override this method if your Objects are more complex or if you need a more specific logic to perform this check.
     *
     * @param mixed $element
     * @return bool
     */
    public function contains($element): bool;
}
