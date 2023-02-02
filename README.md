# React email for Laravel

This package allows you to easily send [React email](https://react.email/) emails with Laravel.

## Install

``` bash
composer require maantje/react-email
yarn add @maantje/react-email
```

## Usage

Install React email ([automatic](https://react.email/docs/getting-started/automatic-setup), [manual](https://react.email/docs/getting-started/manual-setup)).

Create an email in the emails directory e.g. new-user.tsx, make sure the component is the default export.

``` tsx
import { Html } from '@react-email/html';
import { Text } from '@react-email/text';
import * as React from 'react';

export default function Email({ user }) {
    return (
        <Html>
            <Text>Hello, {user.name}</Text>
        </Html>
    );
}
```

Set up the email directory in your Laravel .env.
``` env
REACT_EMAIL_DIRECTORY="/my/absolute/path/to/react-email-starter/emails/"
```

Create a Laravel mailable.

``` bash
php artisan make:mail NewUser
```

Extend from ReactMailable instead of Mailable.

``` php
use App\Models\User;
use Maantje\ReactEmail\ReactMailable;

class NewUser extends ReactMailable
{
    public function __construct(public User $user) 
    {
        // public properties will be passed as props to the React email component
        // Alternatively use the with property of content
    }
    
    public function envelope()
    {
        return new Envelope(
            subject: 'New User',
        );
    }

    public function content()
    {
        return new Content(
            view: 'new-user', // name of the component file without extension
        );
    }
}
```

## Testing

``` bash
./vendor/bin/pest
```

## Security

If you discover any security related issues, please email author email instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](/LICENSE) for more information.
