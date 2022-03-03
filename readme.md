![Logo](https://repository-images.githubusercontent.com/463559799/6ff80679-ea73-42b9-bcb1-cb4e0e77f475)

Laravel package for generating [Laravel Modules](https://github.com/nWidart/laravel-modules) from a template. 

# Requirements

Laravel 8 or 9 and PHP 8.0

# Install

You can install the package via composer:

```bash
composer require dcblogdev/laravel-module-generator
```

Publish both the `config` and `stubs`:

```bash
php artisan vendor:publish --provider="Dcblogdev\Generator\GeneratorServiceProvider"
```

This will publish a `generator.php` config file

This contains:
```php
'default_path' => env('GENERATOR_PATH', 'stubs/generator/module'),
'ignore_files' => ['module.json']
```
By default, the stubs will be located at stubs/generator you can add your own default paths by adding your paths to your .env file or changing the config file.

```bash 
GENERATOR_PATH=your-location
```

# Usage

Create or update the stubs file. The filename and contents should have placeholders for example `ModulesController` will be replaced with your name + Controller. ie `ContactsController` when the command is executed.

Placeholders:

These placeholders are replaced with the name provided when running `php artisan build:template`

Used in filenames:

`Modules` = Module name ie `Contacts`

`modules` = Module name in lowercase ie `contacts`

`Model` = Model name ie `Contact`

`model` = Model name in lowercase ie `contact`

Only used inside files:


`{Modules}` = Module name ie `PurchaseOrders`

`{modules}` = Module name in lowercase ie `purchaseOrder`

`{Model}` = Model name ie `PurchaseOrder`

`{model}` = Model name in lowercase ie `purchaseOrder`

`{module_}` = module name in lowercase ie `purchase_orders`

`{module-}` = module name in lowercase ie `purchase-orders` 

## Change log

Please see the [changelog][3] for more information on what has changed recently.

## Contributing

Contributions are welcome and will be fully credited.

Contributions are accepted via Pull Requests on [Github][4].

## Pull Requests

- **Document any change in behaviour** - Make sure the `readme.md` and any other relevant documentation are kept up-to-date.

- **Consider our release cycle** - We try to follow [SemVer v2.0.0][5]. Randomly breaking public APIs is not an option.

- **One pull request per feature** - If you want to do more than one thing, send multiple pull requests.

## Security

If you discover any security related issues, please email dave@dcblog.dev email instead of using the issue tracker.

## License

license. Please see the [license file][6] for more information.

[3]:    changelog.md
[4]:    https://github.com/dcblogdev/laravel-module-generator
[5]:    http://semver.org/
[6]:    license.md
