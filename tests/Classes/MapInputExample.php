<?php declare(strict_types=1);

namespace Flexboom\PhpData\Tests\Classes;

use Flexboom\PhpData\Attributes\Input\MapInput;
use Flexboom\PhpData\Data;

class MapInputExample extends Data
{
    public function __construct(
        #[MapInput('first_name')]
        public readonly string $firstName,
        #[MapInput('last_name')]
        public readonly string $lastName,
    ) {}
}
