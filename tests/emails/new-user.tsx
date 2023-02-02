import { Html } from '@react-email/html';
import { Text } from '@react-email/text';
import * as React from 'react';

export default function Email({ user }) {
    return (
        <Html>
            <Text>Hello from react email, {user.name}</Text>
        </Html>
    );
}
