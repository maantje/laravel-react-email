import * as React from 'react';
import { Text, Html } from '@react-email/components';

export default function Email({ user }) {
    return (
        <Html>
            <Text>Hello from react email, {user.name}</Text>
        </Html>
    );
}
