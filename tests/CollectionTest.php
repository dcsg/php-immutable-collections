<?php

namespace Tests\DCSG\ImmutableCollections;

use InvalidArgumentException;
use DCSG\ImmutableCollections\Collection;
use DCSG\ImmutableCollections\NotFoundException;
use PHPUnit\Framework\TestCase;

final class CollectionTest extends TestCase
{
    public function testCreate(): void
    {
        $this->assertEquals(['test'], StringCollection::create(['test'])->toArray());
    }

    public function testCreateThrowsOnInvalidItems(): void
    {
        $this->expectException(InvalidArgumentException::class);
        StringCollection::create([1]);
    }

    public function testIsEmpty(): void
    {
        $this->assertTrue(StringCollection::create([])->isEmpty());
    }

    public function testReverse(): void
    {
        $data = ['first', 'middle', 'last'];

        $collection = StringCollection::create($data)
            ->reverse();

        $this->assertEquals('last', $collection->first());
        $this->assertEquals('first', $collection->last());
    }

    public function testSlice(): void
    {
        $data = ['first', 'middle', 'last'];

        $this->assertEquals(
            StringCollection::create(['first', 'middle', 'last']),
            StringCollection::create($data)
                ->slice(0)
        );
        $this->assertEquals(
            StringCollection::create(['middle', 'last']),
            StringCollection::create($data)
                ->slice(1)
        );
        $this->assertEquals(
            StringCollection::create(['last']),
            StringCollection::create($data)
                ->slice(2)
        );
        $this->assertEquals(
            StringCollection::create(['last']),
            StringCollection::create($data)
                ->slice(-1)
        );
        $this->assertEquals(
            StringCollection::create(['middle', 'last']),
            StringCollection::create($data)
                ->slice(-2)
        );
        $this->assertEquals(
            StringCollection::create(['first', 'middle', 'last']),
            StringCollection::create($data)
                ->slice(-3)
        );
    }

    public function testCount(): void
    {
        $data = ['first', 'middle', 'last'];

        $this->assertEquals(3, StringCollection::create($data)->count());
    }

    public function testFirst(): void
    {
        $data = ['first', 'last'];

        $this->assertEquals('first', StringCollection::create($data)->first());
    }

    public function testToArray(): void
    {
        $data = ['first', 'middle', 'last'];

        $this->assertEquals($data, StringCollection::create($data)->toArray());
    }

    public function testMerge(): void
    {
        $data = ['first', 'middle'];
        $toBeMerged = ['last'];

        $this->assertEquals(
            StringCollection::create(['first', 'middle', 'last']),
            StringCollection::create($data)
                ->merge(StringCollection::create($toBeMerged))
        );
        $this->assertEquals(
            3,
            StringCollection::create($data)
                ->merge(StringCollection::create($toBeMerged))
                ->count()
        );
    }

    public function testLast(): void
    {
        $data = ['first', 'last'];

        $this->assertEquals('last', StringCollection::create($data)->last());
    }

    public function testHead(): void
    {
        $data = ['first', 'last'];

        $this->assertEquals('first', StringCollection::create($data)->head());
    }

    public function testTail(): void
    {
        $data = ['first', 'last'];

        $this->assertEquals(StringCollection::create(['last']), StringCollection::create($data)->tail());
    }

    public function testMap(): void
    {
        $this->assertEquals(
            StringCollection::create(['middle', 'middle']),
            StringCollection::create(['first', 'first'])
                ->map(function () {
                    return 'middle';
                })
        );
    }

    public function testFilter(): void
    {
        $data = ['first', 'first', 'last', 'last'];

        $this->assertEquals(
            StringCollection::create(['first', 'first']),
            StringCollection::create($data)
                ->filter(function ($value) {
                    return $value === 'first';
                })
        );
        $this->assertEquals(
            2,
            StringCollection::create($data)
                ->filter(function ($value) {
                    return $value === 'first';
                })
                ->count()
        );
    }

    public function testHasItem(): void
    {
        $collection = StringCollection::create(['test']);

        $this->assertTrue($collection->contains('test'));
    }

    public function testGetItem(): void
    {
        $collection = StringCollection::create(['test']);

        $this->assertEquals('test', $collection->get('test'));
    }

    public function testGetThrowsNotFound(): void
    {
        $collection = StringCollection::create(['test']);

        $this->expectException(NotFoundException::class);
        $collection->get('invalid');
    }

    public function testReduce()
    {
        $collection = StringCollection::create(['foo', 'bar']);

        $this->assertEquals('foobar', $collection->reduce(function (?string $total, $value) {
            return $total . $value;
        }));
    }

}

final class StringCollection extends Collection
{
    protected function validateItems(array $elements): void
    {
        foreach ($elements as $item) {
            if (!is_string($item)) {
                throw new InvalidArgumentException('Invalid value');
            }
        }
    }
}
