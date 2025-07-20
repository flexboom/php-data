<?php declare(strict_types=1);

namespace Flexboom\PhpData;

use Flexboom\PhpData\Contracts\InputAttributeInterface;
use Flexboom\PhpData\Contracts\PriorityInputAttributeInterface;
use Flexboom\PhpData\Exceptions\ConstructorMissingException;
use Flexboom\PhpData\Exceptions\ParameterInputMissingException;
use ReflectionAttribute;
use ReflectionClass;
use ReflectionMethod;
use ReflectionParameter;

abstract class Data
{
    /**
     * @param array<string, mixed> $data
     */
    public static function from(array $data): static
    {
        $class = static::class;
        $reflection = new ReflectionClass($class);
        $constructor = $reflection->getConstructor();

        if (!$constructor instanceof ReflectionMethod) {
            throw new ConstructorMissingException($class);
        }

        $params = [];

        foreach ($constructor->getParameters() as $param) {
            $name = $param->getName();
            $data = self::processAttributes($param->getAttributes(PriorityInputAttributeInterface::class, ReflectionAttribute::IS_INSTANCEOF), $param, $data);
            $data = self::processAttributes($param->getAttributes(InputAttributeInterface::class, ReflectionAttribute::IS_INSTANCEOF), $param, $data);

            if (!array_key_exists($name, $data)) {
                if (!$param->isDefaultValueAvailable()) {
                    throw new ParameterInputMissingException($name, $param->getPosition());
                }

                $data[$name] = $param->getDefaultValue();
            }

            $params[$name] = $data[$name];
        }

        return $reflection->newInstanceArgs($params);
    }

    /**
     * @param array<int, ReflectionAttribute<PriorityInputAttributeInterface|InputAttributeInterface>> $attributes
     * @param array<string, mixed> $data
     *
     * @return array<string, mixed> $data
     */
    private static function processAttributes(array $attributes, ReflectionParameter $param, array $data): array
    {
        foreach ($attributes as $attribute) {
            $data = $attribute->newInstance()->process($param, $data);
        }

        return $data;
    }
}
