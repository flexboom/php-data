<?php declare(strict_types=1);

namespace Flexboom\PhpData\Tests\Classes;

use Flexboom\PhpData\Data;

class BasicExample extends Data
{
    public function __construct(
        public readonly int $id,
        public readonly string $firstName,
        public readonly bool $active,
        public readonly float $number,
    ) {}
}
