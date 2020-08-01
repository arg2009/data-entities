<?php

declare(strict_types=1);

namespace Tests\Unit\Entities;

use Arg2009\DataEntities\AbstractEntity;
use Arg2009\DataEntities\EntityException;

/**
 * Class CarEntity
 * @package Tests\Unit\Entities
 *
 * @property-read string make
 * @property-read int year
 * @property string colour
 */
class CarEntity extends AbstractEntity
{
    protected string $make;
    protected int $year;
    protected string $colour;

    /**
     * CarEntity constructor.
     * @param string $make
     * @param int $year
     * @param string $colour
     * @throws EntityException
     */
    public function __construct(string $make, int $year, string $colour)
    {
        // Read only fields
        $this->make = $make;
        $this->year = $year;

        // Validation
        $this->validateYear();

        // Fields that can be updated should use setters
        $this->setColour($colour);
    }

    /**
     * @param string $colour
     * @throws EntityException
     */
    public function setColour(string $colour): void
    {
        // Setters are also a great place to add some extra validation.
        $acceptedColours = ['red', 'green', 'blue'];
        if (!in_array($colour, $acceptedColours)) {
            throw new EntityException(
                'Sorry, I only know these colours: ' . implode(',', $acceptedColours)
            );
        }

        $this->colour = $colour;
    }

    private function validateYear(): void
    {
        /** @see https://www.google.com/search?&q=the+very+first+car */
        if ($this->year < 1886) {
            throw new EntityException('Invalid Year for a car.');
        }
    }
}