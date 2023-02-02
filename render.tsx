import { render } from '@react-email/render'
import * as React from 'react';

const [node, script, view, json] = process.argv;

import(view).then((module) => {
    const Email = module.default
    const html = render(<Email {...JSON.parse(json)} />, {
        pretty: true,
    });

    const text = render(<Email {...JSON.parse(json)} />, {
        plainText: true,
    });

    console.log(JSON.stringify({html, text}));
})
