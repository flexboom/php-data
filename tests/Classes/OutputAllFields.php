<?php declare(strict_types=1);

namespace Flexboom\PhpData\Tests\Classes;

use Flexboom\PhpData\Data;

class OutputAllFields extends Data
{
    public function __construct(
        public readonly string $firstName,
        public readonly string $middleName,
        public readonly string $lastName,
        public readonly string $nickName,
        private readonly string $notAccessible,
        string $alsoNotAccessible,
    ) {
        assert($this->notAccessible && $alsoNotAccessible);
    }
}
