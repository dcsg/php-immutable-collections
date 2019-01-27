# Minimalist and Typed Immutable Collections for PHP
[![Build Status](https://travis-ci.org/dcsg/php-immutable-collections.svg?branch=master)](https://travis-ci.org/dcsg/php-immutable-collections) [![SymfonyInsight](https://insight.symfony.com/projects/8cc27627-24e7-407c-9839-766c9946eb2c/mini.svg)](https://insight.symfony.com/projects/8cc27627-24e7-407c-9839-766c9946eb2c) [![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=dcsg_php-immutable-collections&metric=alert_status)](https://sonarcloud.io/dashboard?id=dcsg_php-immutable-collections) [![Coverage](https://sonarcloud.io/api/project_badges/measure?project=dcsg_php-immutable-collections&metric=coverage)](https://sonarcloud.io/dashboard?id=dcsg_php-immutable-collections) [![Vulnerabilities](https://sonarcloud.io/api/project_badges/measure?project=dcsg_php-immutable-collections&metric=vulnerabilities)](https://sonarcloud.io/dashboard?id=dcsg_php-immutable-collections) [![Bugs](https://sonarcloud.io/api/project_badges/measure?project=dcsg_php-immutable-collections&metric=bugs)](https://sonarcloud.io/dashboard?id=dcsg_php-immutable-collections) [![Security Rating](https://sonarcloud.io/api/project_badges/measure?project=dcsg_php-immutable-collections&metric=security_rating)](https://sonarcloud.io/dashboard?id=dcsg_php-immutable-collections)

A library that provides a set of minimalist, typed and piped Immutable Collections for PHP.

###### Requirements

PHP > 7.1

###### Installation

```bash
composer require dcsg/php-immutable-collections
```

#### What Problems does this solve?

The lack of Generics in PHP does not allow to have typed collections in PHP.

This Library provides two abstract Immutable Collections:

* Immutable List Collection - ImmutableCollection
* Immutable Set Collection - SetImmutableCollection

#### Why Typed Immutable Collections

###### Typed Collections

Since PHP does not have [Generics](https://en.wikipedia.org/wiki/Generics_in_Java) like Java has, it's not possible to have native typed collections.
The Collections available in this Library are the foundation for you to create your own Typed Collections, you just need to extend them.

###### Typed Immutable Collections for [DDD (Domain Driven Design)](https://en.wikipedia.org/wiki/Domain-driven_design)

DDD is all about having your code speaking the business language, the called Ubiquitous Language. Without Collections in PHP this is very hard to achieve using `Arrays` because you cannot add behavior to them. So what usually happens you add that behavior to your entity but it shouldn't be there. Another problem is the mutability of `Arrays`, `VOs` (Value Objects) **MUST** be always **immutable** and that's impossible with `Arrays` and you should always guarantee that the `elements` of that `Array` are all of the same type. 

#### Collections vs [Arrays](https://secure.php.net/manual/pt_BR/language.types.array.php)

* `Collections` and `Arrays` both represent a Group of Elements.
* `Collections` are not natively supported by PHP while `Arrays` are.
* `Arrays` is THE data structure of PHP and is used for almost everything.
* `Arrays` don't allow you to add new behavior while `Collections` allow it.
* `Arrays` don't allow you to define a **type** for its elements while `Collections` allow it.  

#### Other PHP Collections

There are other Collections for PHP out there, naming a few we have [Doctrine Collections](https://github.com/doctrine/collections/tree/master/lib/Doctrine/Common/Collections) and [Illuminate Collections](https://github.com/illuminate/support/blob/master/Collection.php).
Those collections they solve different problems, are tailored to their specific use case, and their APIs are extensive and more important those Collections are Mutable.
These combinations make it difficult to use those Collections for more simple use cases.
That's why the Collections we provide here, have a very small API and don't even expose the Iterator API.
This way you have the possibility to use them and extend it's behavior tailored for your needs. 

#### Features

* Static construction for pipe usage.
* Util methods like `isEmpty`, `count`, `toArray`, `contains`, `get` ,`map`, `filter`, `slice`, `merge`, `reverse`, `reduce`, `first`, `last`, `head`, `tail`.

#### Basic usage

###### Creating a Typed List Collection

```php
<?php declare(strict_types=1);

use DCSG\ImmutableCollections\ImmutableCollection;

final class MyStringCollection extends ImmutableCollection {
    ImmutableCollection
    protected function validateItems(array $elements): void
    {
        foreach ($elements as $element) {
            if (!\is_string($element)) {
                throw new InvalidArgumentException('Element is not a String.');
            }
        }
    }
}

$collection = MyStringCollection::create(['foo', 'bar']);
echo $collection->count(); // 2
```

###### Creating a Typed Set Collection

```php
<?php declare(strict_types=1);

use DCSG\ImmutableCollections\SetImmutableCollection;

final class MyStringSetCollection extends SetImmutableCollection {
    ImmutableCollection
    protected function validateItems(array $elements): void
    {
        foreach ($elements as $element) {
            if (!\is_string($element)) {
                throw new InvalidArgumentException('Element is not a String.');
            }
        }
    }
}

$collection = MyStringSetCollection::create(['foo', 'bar']);
echo $collection->count(); // 2

$collection = MyStringSetCollection::create(['foo', 'bar', 'foo']); // Throws InvalidArgumentException
```

## Examples

We provide two simple examples for better understanding. One related to [invoices](https://github.com/dcsg/php-immutable-collections/blob/master/examples/Invoices/app.php) and another one regarding [Legs of a Cargo Ship](https://github.com/dcsg/php-immutable-collections/blob/master/examples/CargoLegs/app.php).
