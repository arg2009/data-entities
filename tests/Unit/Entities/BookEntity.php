<?php

declare(strict_types=1);

namespace Tests\Unit\Entities;

use Arg2009\DataEntities\AbstractEntity;

/**
 * Class BookEntity
 * @package Tests\Unit\Entities
 *
 * @property-read string name
 * @property-read string author
 * @property-read string isbn
 */
class BookEntity extends AbstractEntity
{
    protected string $name;
    protected string $author;
    protected string $isbn;

    /**
     * BookEntity constructor.
     * @param string $name
     * @param string $author
     * @param string $isbn
     */
    public function __construct(string $name, string $author, string $isbn)
    {
        $this->name = $name;
        $this->author = $author;
        $this->isbn = $isbn;
    }
}