# React Email for Laravel

Easily send [React Email](https://react.email/) emails with Laravel using this package.

## Installation

First, install the package via Composer:

```bash
composer require maantje/react-email
```

Then, install the required Node dependencies:

```bash
npm install vendor/maantje/react-email
```

## Getting Started

1. Install React Email using the [automatic](https://react.email/docs/getting-started/automatic-setup) or [manual](https://react.email/docs/getting-started/manual-setup) setup.
2. Create an email component in the `emails` directory (e.g., `new-user.tsx`). Ensure the component is the default export.

Example email component:

```tsx
import * as React from 'react';
import { Text, Html } from '@react-email/components';

export default function Email({ user }) {
    return (
        <Html>
            <Text>Hello, {user.name}</Text>
        </Html>
    );
}
```

3. Define the email directory path in your Laravel `.env` file:

```env
REACT_EMAIL_DIRECTORY="emails/directory/relative/from/laravel/root"
```

4. Generate a new Laravel Mailable class:

```bash
php artisan make:mail NewUser
```

5. Use `ReactMailView` in your `Mailable`, or extend your `Mailable` from `ReactMailable``

```php
use App\Models\User;
use Maantje\ReactEmail\ReactMailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Content;
use Maantje\ReactEmail\ReactMailView;

class NewUser extends ReactMailable // Extend, from \Maantje\ReactEmail\ReactMailable
{
    use ReactMailView; // or use \Maantje\ReactEmail\ReactMailView
    
    public function __construct(public User $user)
    {
        // Public properties will be passed as props to the React email component.
        // Alternatively, use the `with` property of `content`.
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
            view: 'new-user', // Component filename without the extension
        );
    }
}
```

## Running Tests

Run tests using [Pest](https://pestphp.com/):

```bash
./vendor/bin/pest
```

## Security

If you discover any security-related issues, please email the author instead of using the issue tracker.

## License

This package is open-source and licensed under the MIT License. See the [LICENSE](/LICENSE) file for details.~~

