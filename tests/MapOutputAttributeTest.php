<?php declare(strict_types=1);

namespace Flexboom\PhpData\Tests;

use Flexboom\PhpData\Tests\Classes\MapOutputExample;
use PHPUnit\Framework\TestCase;

class MapOutputAttributeTest extends TestCase
{
    public function testSimpleMap(): void
    {
        $object = MapOutputExample::from([
            'firstName' => 'John',
            'lastName' => 'Doe',
        ]);

        $expected = [
            'first_name' => 'John',
            'last_name' => 'Doe',
        ];

        $this->assertSame($expected, $object->all());
    }
}
