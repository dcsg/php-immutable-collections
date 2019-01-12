<?php /** @noinspection PhpMultipleClassesDeclarationsInOneFile */

namespace Tests\DCSG\ImmutableCollections;

use InvalidArgumentException;
use DCSG\ImmutableCollections\SetCollection;
use PHPUnit\Framework\TestCase;

final class SetCollectionTest extends TestCase
{
    public function testCreateThrowsWhenThereAreDuplicates(): void
    {
        $this->expectException(InvalidArgumentException::class);
        StringSetCollection::create(['test', 'test']);
    }

    public function testCreateWithValidElements(): void
    {
        $this->assertCount(2, StringSetCollection::create(['test', 'test1']));
    }
}

final class StringSetCollection extends SetCollection
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
