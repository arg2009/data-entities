<?php

declare(strict_types=1);

namespace Arg2009\DataEntities;

abstract class AbstractEntity implements EntityInterface
{
    const READ_ONLY_ERROR_MESSAGE = 'Data Entities are ready only by default. Define a setter to allow manipulating fields.';
    const PROPERTY_DOES_NOT_EXIST_MESSAGE = 'Property does not exist.';

    /**
     * Force Data Entities as read only by default.
     *
     * @param $name
     * @param $value
     * @return mixed
     * @throws EntityException
     */
    public function __set($name, $value)
    {
        $setterMethodName = 'set' . ucfirst($name);
        if (method_exists($this, $setterMethodName)) {
            return $this->{$setterMethodName}($value);
        }

        throw new EntityException(self::READ_ONLY_ERROR_MESSAGE);
    }

    /**
     * Grant Read Only access to the properties by default.
     *
     * @param $name
     * @return mixed
     * @throws EntityException
     */
    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->{$name};
        }

        throw new EntityException(self::PROPERTY_DOES_NOT_EXIST_MESSAGE);
    }
}
