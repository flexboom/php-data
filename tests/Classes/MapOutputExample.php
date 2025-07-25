<?php declare(strict_types=1);

namespace Flexboom\PhpData\Tests\Classes;

use Flexboom\PhpData\Attributes\Input\MapOutput;
use Flexboom\PhpData\Data;

class MapOutputExample extends Data
{
    public function __construct(
        #[MapOutput('first_name')]
        public readonly string $firstName,
        #[MapOutput('last_name')]
        public readonly string $lastName,
    ) {}
}
