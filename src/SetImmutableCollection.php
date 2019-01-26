<?php

namespace DCSG\ImmutableCollections;

use InvalidArgumentException;

/**
 * @author Daniel Gomes <danielcesargomes@gmail.com>
 */
abstract class SetImmutableCollection extends ImmutableCollection
{
    protected function __construct(array $elements)
    {
        $_elements = [];
        foreach ($elements as $element) {
            if (in_array($element, $_elements, true)) {
                throw new InvalidArgumentException('Duplicated element found.');
            }

            $_elements[] = $element;
        }

        parent::__construct($_elements);
    }
}
