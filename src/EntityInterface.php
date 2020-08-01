<?php

declare(strict_types=1);

namespace Arg2009\DataEntities;

interface EntityInterface
{
    public function __set($name, $value);

    public function __get($name);
}
