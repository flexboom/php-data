<?php declare(strict_types=1);

namespace Flexboom\PhpData\Attributes\Input;

use Attribute;
use Flexboom\PhpData\Contracts\LastOutputAttributeInterface;
use Override;
use ReflectionParameter;

#[Attribute(Attribute::TARGET_PARAMETER)]
class MapOutput implements LastOutputAttributeInterface
{
    public function __construct(
        private readonly string $name,
    ) {}

    #[Override]
    public function process(ReflectionParameter $param, array $data): array
    {
        $transformed = [];

        foreach ($data as $key => $value) {
            if ($key === $param->getName()) {
                $transformed[$this->name] = $value;
            } else {
                $transformed[$key] = $value;
            }
        }

        return $transformed;
    }
}
