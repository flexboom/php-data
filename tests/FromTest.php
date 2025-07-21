<?php declare(strict_types=1);

namespace Flexboom\PhpData\Tests;

use Flexboom\PhpData\Exceptions\ConstructorMissingException;
use Flexboom\PhpData\Exceptions\ParameterInputMissingException;
use Flexboom\PhpData\Tests\Classes\BasicExample;
use Flexboom\PhpData\Tests\Classes\NoConstructor;
use PHPUnit\Framework\TestCase;

class FromTest extends TestCase
{
    public function testSameOrder(): void
    {
        $basicExample = BasicExample::from([
            'id' => 456,
            'firstName' => 'John',
            'active' => true,
            'number' => 200.123,
            'discard' => 'not used',
        ]);

        $expected = [
            'id' => 456,
            'firstName' => 'John',
            'active' => true,
            'number' => 200.123,
        ];

        $this->assertSame($expected, get_object_vars($basicExample));
    }

    public function testRandomOrder(): void
    {
        $basicExample = BasicExample::from([
            'active' => true,
            'discard' => 'not used',
            'number' => 200.123,
            'firstName' => 'John',
            'id' => 456,
        ]);

        $expected = [
            'id' => 456,
            'firstName' => 'John',
            'active' => true,
            'number' => 200.123,
        ];

        $this->assertSame($expected, get_object_vars($basicExample));
    }

    public function testParameterMissing(): void
    {
        $this->expectException(ParameterInputMissingException::class);
        $this->expectExceptionMessage('Input for #1 id missing');
        $this->expectExceptionCode(0);

        BasicExample::from([
            'active' => true,
            'discard' => 'not used',
            'number' => 200.123,
            'firstName' => 'John',
        ]);
    }

    public function testNoConstructor(): void
    {
        $this->expectException(ConstructorMissingException::class);
        $this->expectExceptionMessage('NoConstructor must have a constructor');
        $this->expectExceptionCode(0);

        NoConstructor::from(['firstName' => 'John']);
    }
}
