<?php declare(strict_types=1);

namespace Flexboom\PhpData\Tests;

use Flexboom\PhpData\Tests\Classes\OutputAllFields;
use PHPUnit\Framework\TestCase;

class ExceptTest extends TestCase
{
    public function testExceptSomeFields(): void
    {
        $object = OutputAllFields::from([
            'firstName' => 'John',
            'middleName' => 'Paul',
            'lastName' => 'Doe',
            'nickName' => 'Johnny',
            'notAccessible' => 'discard',
            'alsoNotAccessible' => 'discard',
        ]);

        $expected = [
            'firstName' => 'John',
            'lastName' => 'Doe',
        ];

        $this->assertSame($expected, $object->except(['middleName', 'nickName']));
    }
}
