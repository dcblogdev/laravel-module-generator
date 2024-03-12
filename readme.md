## Community

There is a Discord community. https://discord.gg/VYau8hgwrm For quick help, ask questions in the appropriate channel.

![Logo](https://repository-images.githubusercontent.com/463559799/6ff80679-ea73-42b9-bcb1-cb4e0e77f475)

Laravel package for generating [Laravel Modules](https://github.com/nWidart/laravel-modules) from a template. 

# Requirements

PHP 8.1+
Laravel Modules package installed https://github.com/nWidart/laravel-modules

## Video demo

[![Intro video](https://github.com/dcblogdev/laravel-module-generator/assets/1018170/523f2c4b-a57d-4ae0-8351-6b08d7b8c87c)](https://www.youtube.com/watch?v=BwYzfb9Fa8A&t=2s)

https://www.youtube.com/watch?v=BwYzfb9Fa8A&t=2s

# Install

You can install the package via composer:

```bash
composer require dcblogdev/laravel-module-generator
```

Publish both the `config` and `stubs`:

```bash
php artisan vendor:publish --provider="Dcblogdev\ModuleGenerator\ModuleGeneratorServiceProvider"
```

This will publish a `module-generator.php` config file

This contains:
```php
'template' => [
    'Breeze - Blade - CRUD Web & API' => 'stubs/module-generator/breeze-crud-full',
    'Breeze - Blade - CRUD Web only' => 'stubs/module-generator/breeze-crud-web',
    'Breeze - Blade - CRUD API only' => 'stubs/module-generator/breeze-crud-api'
],
'ignore_files' => ['module.json']
```
By default, the stubs will be located at stubs/module-generator you can add your paths by adding folders and updating the config file.

# Usage

```bash
php artisan module:build
```

<img width="737" alt="300550938-529c214d-a02a-4577-8904-c865b2f41f7e" src="https://github.com/dcblogdev/laravel-module-generator/assets/1018170/82c0828f-b9d6-4eff-b7ca-908b46fe37e7">

{module?} is the name of the module you want to create. If you don't provide a name you will be asked to enter one.

{template?} is the name of the template you want to use. If you don't provide a name you will be asked to enter one.

```bash
php artisan module:build Contacts "Breeze - CRUD API only"
```

Create or update the stubs file. The filename and contents should have placeholders for example `ModulesController` will be replaced with your name + Controller. ie `ContactsController` when the command is executed.

## Placeholders:

These placeholders are replaced with the name provided when running `php artisan module:build`

### Used in filenames:

`Module` = Module name ie `Contacts`

`module` = Module name in lowercase ie `contacts`

`Model` = Model name ie `Contact`

`model` = Model name in lowercase ie `contact`

### Only used inside files:

`{Module}` = Module name ie `PurchaseOrders`

`{module}` = Module name in lowercase ie `purchaseOrder`

`{module_}` = module name with underscores ie `purchase_orders`

`{module-}` = module name with hyphens ie `purchase-orders`

`{module }` = module name puts space between capital letters ie `PurchaseOrders` becomes `Purchase Orders`

`{Model}` = Model name ie `PurchaseOrder`

`{model}` = Model name in lowercase ie `purchaseOrder`

`{model_}` = model name with underscores ie `purchase_orders`

`{model-}` = model name with hyphens ie `purchase-orders`

`{model }` = model name puts space between capital letters ie `PurchaseOrder` becomes `Purchase Order`

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
