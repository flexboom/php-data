<?php declare(strict_types=1);

namespace Flexboom\PhpData\Tests;

use Flexboom\PhpData\Tests\Classes\OutputAllFields;
use PHPUnit\Framework\TestCase;

class OnlyTest extends TestCase
{
    public function testOnlyIncludeSomeFields(): void
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

        $this->assertSame($expected, $object->only(['firstName', 'lastName']));
    }
}
