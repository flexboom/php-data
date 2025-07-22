![PHPStan Level max](https://img.shields.io/badge/PHPStan-level%20max-brightgreen.svg?style=flat)
![CI](https://github.com/github/docs/actions/workflows/main.yml/badge.svg?branch=main)

# PHP data

Getting data from e.g. a API response and convert it to strongly typed data can be a hassle, this package addresses that.

## Quick start

Installation: `composer require flexboom/php-data`

```
use Flexboom\PhpData\Attributes\Input\MapInput;
use Flexboom\PhpData\Data;

class Product extends Data
{
    public function __construct(
        public readonly int $id,
        public readonly bool $published,
        public readonly string $name,
        #[MapInput('supplier_name')]
        public readonly string $supplierName,
        public readonly float $price,
    ) {}
}

$data = Product::from([
    'id' => 123,
    'published' => true,
    'name' => 'Suitcase',
    'supplier_name' => 'John Doe Inc.',
    'price' => 500.99,
]);
```
- The order of elements in the array do not matter.
- `#[MapInput('supplier_name')]` maps the element with the key `supplier_name` to `$supplierName` when instantiating the object.

## Notes

- Run tests: `./vendor/bin/phpunit --colors tests`
- Fix code style: `./vendor/bin/php-cs-fixer fix src --dry-run --diff`
- Static analysis: `./vendor/bin/phpstan`

[Spatie Laravel Data](https://github.com/spatie/laravel-data) is a great but this package is made with vanilla PHP in mind.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
