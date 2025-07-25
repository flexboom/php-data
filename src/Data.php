<?php declare(strict_types=1);

namespace Flexboom\PhpData;

use Flexboom\PhpData\Contracts\InputAttributeInterface;
use Flexboom\PhpData\Contracts\LastOutputAttributeInterface;
use Flexboom\PhpData\Contracts\OutputAttributeInterface;
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
     * @param array<int, ReflectionAttribute<PriorityInputAttributeInterface|InputAttributeInterface|LastOutputAttributeInterface|OutputAttributeInterface>> $attributes
     * @param array<string, mixed> $data
     *
     * @return array<string, mixed>
     */
    private static function transformAttributes(array $attributes, ReflectionParameter $param, array $data): array
    {
        foreach ($attributes as $attribute) {
            $data = $attribute->newInstance()->process($param, $data);
        }

        return $data;
    }

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
            $data = self::transformAttributes($param->getAttributes(PriorityInputAttributeInterface::class, ReflectionAttribute::IS_INSTANCEOF), $param, $data);
            $data = self::transformAttributes($param->getAttributes(InputAttributeInterface::class, ReflectionAttribute::IS_INSTANCEOF), $param, $data);

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
     * @return array<string, mixed>
     */
    public function all(): array
    {
        $reflection = new ReflectionClass(static::class);
        $constructor = $reflection->getConstructor();
        $data = get_object_vars($this);

        if ($constructor instanceof ReflectionMethod) {
            foreach ($constructor->getParameters() as $param) {
                $data = self::transformAttributes($param->getAttributes(OutputAttributeInterface::class, ReflectionAttribute::IS_INSTANCEOF), $param, $data);
                $data = self::transformAttributes($param->getAttributes(LastOutputAttributeInterface::class, ReflectionAttribute::IS_INSTANCEOF), $param, $data);
            }
        }

        return $data;
    }

    /**
     * @param array<int, string> $exclude
     *
     * @return array<string, mixed>
     */
    public function except(array $exclude = []): array
    {
        return array_diff_key($this->all(), array_flip($exclude));
    }

    /**
     * @param array<int, string> $include
     *
     * @return array<string, mixed>
     */
    public function only(array $include = []): array
    {
        return array_intersect_key($this->all(), array_flip($include));
    }
}
