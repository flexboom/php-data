<?php declare(strict_types=1);

namespace Flexboom\PhpData\Exceptions;

use RuntimeException;
use Throwable;

class ParameterInputMissingException extends RuntimeException
{
    public function __construct(string $paramName, int $position, ?Throwable $previous = null)
    {
        $position++;
        parent::__construct("Input for #{$position} {$paramName} missing", 0, $previous);
    }
}
