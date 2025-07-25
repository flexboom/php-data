<?php declare(strict_types=1);

namespace Flexboom\PhpData\Contracts;

use ReflectionParameter;

interface LastOutputAttributeInterface
{
    /**
     * @template Tvalue
     * @param array<string, Tvalue> $data
     *
     * @return array<string, Tvalue>
     */
    public function process(ReflectionParameter $param, array $data): array;
}
