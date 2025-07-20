<?php declare(strict_types=1);

namespace Flexboom\PhpData\Attributes\Input;

use Attribute;
use Flexboom\PhpData\Contracts\PriorityInputAttributeInterface;
use Flexboom\PhpData\Exceptions\InputMissingException;
use Override;
use ReflectionParameter;

#[Attribute(Attribute::TARGET_PARAMETER)]
class MapInput implements PriorityInputAttributeInterface
{
    public function __construct(
        private readonly string $name,
    ) {}

    #[Override]
    public function process(ReflectionParameter $param, array $data): array
    {
        $transformed = [];

        if (array_key_exists($param->getName(), $data)) {
            return $data;
        }

        if (!array_key_exists($this->name, $data)) {
            throw new InputMissingException($this->name, $param->getName(), $param->getPosition());
        }

        foreach ($data as $key => $value) {
            if ($key === $this->name) {
                $transformed[$param->getName()] = $value;
            } else {
                $transformed[$key] = $value;
            }
        }

        return $transformed;
    }
}
