<?php declare(strict_types=1);

namespace Flexboom\PhpData\Exceptions;

use RuntimeException;
use Throwable;

class InputMissingException extends RuntimeException
{
    public function __construct(string $inputName, string $paramName, int $position, ?Throwable $previous = null)
    {
        $position++;
        parent::__construct("Input does not contain {$inputName} that are mapped to #{$position} {$paramName}", 0, $previous);
    }
}
