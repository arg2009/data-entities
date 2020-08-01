<?php

declare(strict_types=1);

namespace Tests\Unit;

use Arg2009\DataEntities\AbstractEntity;
use Arg2009\DataEntities\EntityException;
use PHPUnit\Framework\TestCase;
use Tests\Traits\CanTestExceptions;
use Tests\Unit\Entities\BookEntity;
use Tests\Unit\Entities\CarEntity;

final class DataEntityTest extends TestCase
{
    use CanTestExceptions;

    /** @test */
    public function data_entities_are_read_only_by_default()
    {
        $bookName = 'Book Name';
        $bookAuthor = 'Book Author';
        $bookIsbn = 'Book ISBN';

        $bookEntity = new BookEntity($bookName, $bookAuthor, $bookIsbn);

        // All properties are readable
        $this->assertEquals($bookName, $bookEntity->name);
        $this->assertEquals($bookAuthor, $bookEntity->author);
        $this->assertEquals($bookIsbn, $bookEntity->isbn);

        // All properties are not writable
        $this->assertException(
            fn () => $bookEntity->name = $bookEntity->name . '2',
            EntityException::class,
            AbstractEntity::READ_ONLY_ERROR_MESSAGE,
            0
        );

        $this->assertException(
            fn () => $bookEntity->author = $bookEntity->author . '2',
            EntityException::class,
            AbstractEntity::READ_ONLY_ERROR_MESSAGE,
            0
        );

        $this->assertException(
            fn () => $bookEntity->isbn = $bookEntity->isbn . '2',
            EntityException::class,
            AbstractEntity::READ_ONLY_ERROR_MESSAGE,
            0
        );
    }

    /** @test */
    public function data_entities_are_updatable_via_setters()
    {
        $car = new CarEntity('Toyota',  1995, 'red');

        // Properties without setters are not writable
        $this->assertException(
            fn () => $car->make = 'Ferrari',
            EntityException::class,
            AbstractEntity::READ_ONLY_ERROR_MESSAGE,
            0
        );

        // Properties with setters are writable
        $car->colour = 'blue';
        $this->assertEquals('blue', $car->colour);

        // Setters can be used for validation purposes
        $this->assertException(
            fn () => $car->colour = 'pink',
            EntityException::class
        );

        // Read Only Properties can have validation too
        $this->assertException(
            fn () => new CarEntity('Toyota',  1400, 'red'),
            EntityException::class
        );
    }
}