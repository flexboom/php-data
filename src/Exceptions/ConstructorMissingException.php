<?php declare(strict_types=1);

namespace Flexboom\PhpData\Exceptions;

use RuntimeException;
use Throwable;

class ConstructorMissingException extends RuntimeException
{
    public function __construct(string $className, ?Throwable $previous = null)
    {
        parent::__construct("{$className} must have a constructor", 0, $previous);
    }
}
