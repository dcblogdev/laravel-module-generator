
[![Latest Version on Packagist](https://img.shields.io/packagist/v/dcblogdev/laravel-generator.svg?style=flat-square)](https://packagist.org/packages/dcblogdev/laravel-generator)
[![Total Downloads](https://img.shields.io/packagist/dt/dcblogdev/laravel-generator.svg?style=flat-square)](https://packagist.org/packages/dcblogdev/laravel-generator)

Laravel package for generating custom file structures based on templates.

# Install

You can install the package via composer:

```
composer require dcblogdev/laravel-generator
```

# Config

You can publish the config file with:

```
php artisan vendor:publish --provider="Dcblogdev\Generator\GeneratorServiceProvider" --tag="config"
```

.ENV Configuration
Ensure you've set the following in your .env file:

```

```

# Usage

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
[4]:    https://github.com/dcblogdev/laravel-generator
[5]:    http://semver.org/
[6]:    license.md
