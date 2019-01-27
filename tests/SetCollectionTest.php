<?php declare(strict_types=1); // phpcs:disable PSR1.Classes.ClassDeclaration.MultipleClasses


namespace Tests\DCSG\ImmutableCollections;

use InvalidArgumentException;
use DCSG\ImmutableCollections\SetImmutableCollection;
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

final class StringSetCollection extends SetImmutableCollection
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
