<?php declare(strict_types=1);

namespace Tests\DCSG\ImmutableCollections;

use DCSG\ImmutableCollections\CollectionIterator;
use PHPUnit\Framework\TestCase;

final class CollectionIteratorTest extends TestCase
{
    public function testCurrent(): void
    {
        $data = ['first', 'middle', 'last'];

        $collection = new CollectionIterator($data);
        $this->assertEquals('first', $collection->current());
    }

    public function testRewind(): void
    {
        $data = ['first', 'middle', 'last'];
        $collection = new CollectionIterator($data);

        $this->assertEquals(0, $collection->key());

        $collection->next();
        $this->assertEquals(1, $collection->key());

        $collection->rewind();
        $this->assertEquals(0, $collection->key());
    }

    public function testNext(): void
    {
        $data = ['first', 'middle', 'last'];

        $collection = new CollectionIterator($data);
        $this->assertEquals('first', $collection->current());

        $collection->next();
        $this->assertEquals('middle', $collection->current());
    }

    public function testValid(): void
    {
        $data = ['first'];

        $collection = new CollectionIterator($data);
        $collection->next();

        $newCollection = new CollectionIterator($data);
        $this->assertTrue($newCollection->valid());
        $this->assertFalse($collection->valid());

        $collection->rewind();
        $this->assertTrue($collection->valid());
    }

    public function testKey(): void
    {
        $data = ['first'];
        $collection = new CollectionIterator($data);

        $this->assertEquals(0, $collection->key());
    }
}
