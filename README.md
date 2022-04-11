# Laravel Todo package

This package adds Todo ability to the main laravel project

## Installation

You can install the package via composer:

```bash
composer require abedimostafa/to_do
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

## considerations
- Be sure to use ExtendedUser with correct namespace
- Set up the email configuration in the .env file before using the package

## Usage

It's all set, hit /login url and enjoy the package

- [Mostafa Abedi](https://www.linkedin.com/in/mostafa-abedi-081785157/)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
