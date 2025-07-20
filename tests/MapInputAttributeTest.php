<?php declare(strict_types=1);

namespace Flexboom\PhpData\Tests;

use Flexboom\PhpData\Exceptions\InputMissingException;
use Flexboom\PhpData\Tests\Classes\MapInputExample;
use PHPUnit\Framework\TestCase;

class MapInputAttributeTest extends TestCase
{
    public function testSimpleMap(): void
    {
        $object = MapInputExample::from([
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);

        $expected = [
            'firstName' => 'John',
            'lastName' => 'Doe',
        ];

        $this->assertSame($expected, get_object_vars($object));
    }

    public function testDoNotOverwriteIfExist(): void
    {
        $object = MapInputExample::from([
            'first_name' => 'Jack',
            'firstName' => 'John',
            'lastName' => 'Doe',
            'last_name' => 'Smith',
        ]);

        $expected = [
            'firstName' => 'John',
            'lastName' => 'Doe',
        ];

        $this->assertSame($expected, get_object_vars($object));
    }

    public function testInputMissing(): void
    {
        $this->expectException(InputMissingException::class);
        $this->expectExceptionMessage('Input does not contain last_name that are mapped to #2 lastName');
        $this->expectExceptionCode(0);

        MapInputExample::from([
            'first_name' => 'Jack',
        ]);
    }
}
