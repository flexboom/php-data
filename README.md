![PHPStan Level max](https://img.shields.io/badge/PHPStan-level%20max-brightgreen.svg?style=flat)
[![Continuous Integration](https://github.com/flexboom/php-data/actions/workflows/main.yml/badge.svg)](https://github.com/flexboom/php-data/actions/workflows/main.yml)

# PHP data

Getting data from e.g. a API response and convert it to strongly typed data can be a hassle, this package addresses that.

## Quick start

Installation: `composer require flexboom/php-data`

Instantiate a new object:

```
use Flexboom\PhpData\Attributes\Input\MapInput;
use Flexboom\PhpData\Attributes\Input\MapOutput;
use Flexboom\PhpData\Data;

class Product extends Data
{
    public function __construct(
        public readonly int $id,
        public readonly bool $published,
        public readonly string $name,
        #[MapInput('supplier_name')]
        #[MapOutput('supplier_name')]
        public readonly string $supplierName,
        public readonly float $price,
    ) {}
}

$object = Product::from([
    'id' => 123,
    'published' => true,
    'name' => 'Suitcase',
    'supplier_name' => 'John Doe Inc.',
    'price' => 500.99,
]);
```

Get the public properties as an array:

```
$object->all();

[
    'id' => 123,
    'published' => true,
    'name' => 'Suitcase',
    'supplier_name' => 'John Doe Inc.',
    'price' => 500.99,
]

$object->except(['published', 'price']);

[
    'id' => 123,
    'name' => 'Suitcase',
    'supplier_name' => 'John Doe Inc.',
]

$object->only(['id', 'name']);

[
    'id' => 123,
    'name' => 'Suitcase',
]
```

- The order of elements in the array do not matter.
- `#[MapInput('supplier_name')]` maps the element with the key `supplier_name` to `$supplierName` when instantiating the object.
- `#[MapOutput('supplier_name')]` changes the property `supplierName` to `supplier_name`.

## Notes

- Run tests: `./vendor/bin/phpunit --colors tests`
- Check code style: `./vendor/bin/php-cs-fixer fix src --dry-run --diff`
- Run static analysis: `./vendor/bin/phpstan`

[Spatie Laravel Data](https://github.com/spatie/laravel-data) is a great but this package is made for native PHP.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
