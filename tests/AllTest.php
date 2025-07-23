<?php declare(strict_types=1);

namespace Flexboom\PhpData\Tests;

use Flexboom\PhpData\Tests\Classes\OutputAllFields;
use PHPUnit\Framework\TestCase;

class AllTest extends TestCase
{
    public function testAllFields(): void
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
            'middleName' => 'Paul',
            'lastName' => 'Doe',
            'nickName' => 'Johnny',
        ];

        $this->assertSame($expected, $object->all());
    }
}
