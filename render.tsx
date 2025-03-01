import { render } from '@react-email/render'
import * as React from 'react';
import * as process from "node:process";

const [node, script, view, json] = process.argv;

import(view).then(async (module) => {
    const Email = module.default
    const html = await render(<Email {...JSON.parse(json)} />);
    const text = await render(<Email {...JSON.parse(json)} />, {
        plainText: true,
    });


    console.log(JSON.stringify({html, text}));
})
