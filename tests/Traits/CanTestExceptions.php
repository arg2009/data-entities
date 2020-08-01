<?php

declare(strict_types=1);

namespace Tests\Traits;

use Exception;

/**
 * Trait TestsExceptions
 * @package Tests\Traits
 */
trait CanTestExceptions
{
    public function assertException(
        callable $callback,
        ?string $exceptionFQCN = null,
        ?string $message = null,
        ?int $code = null
    ): void {
        $assertingException = new Exception();

        try {
            $callback();
        } catch (Exception $exception) {
            $assertingException = $exception;
        }

        $message && $this->assertEquals($message, $assertingException->getMessage());
        $code && $this->assertEquals($message, $assertingException->getMessage());
        $exceptionFQCN && $this->assertEquals($exceptionFQCN, get_class($assertingException));
    }
}