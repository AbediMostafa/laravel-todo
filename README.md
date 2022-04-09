# Laravel Todo package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/abedimostafa/laravel-todo-package.svg?style=flat-square)](https://packagist.org/packages/abedimostafa/laravel-todo-package)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/abedimostafa/laravel-todo-package/run-tests?label=tests)](https://github.com/abedimostafa/laravel-todo-package/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/abedimostafa/laravel-todo-package/Check%20&%20fix%20styling?label=code%20style)](https://github.com/abedimostafa/laravel-todo-package/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/abedimostafa/laravel-todo-package.svg?style=flat-square)](https://packagist.org/packages/abedimostafa/laravel-todo-package)

This package adds Todo ability to the main laravel project

## Installation

You can install the package via composer:

```bash
composer require abedimostafa/laravel-todo-package
```

You can publish and run the migrations with:

```
php artisan vendor:publish --tag="todo-app" --force
php artisan migrate
```

- For getting access to the authenticated user and relation methods add ExtendedUser trait to the User model :

```
use AbediMostafa\ToDo\http\Models\Traits\ExtendedUser;

class User extends Authenticatable
{
    use Notifiable,ExtendedUser;
```

## Usage

It's all set, hit /login url and enjoy the package
## Testing

```bash
composer test
```

- [Mostafa Abedi](https://www.linkedin.com/in/mostafa-abedi-081785157/)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
