<?php

return [
    'company' => [
        'name' => env('APP_COMPANY_NAME'),
    ],

    'binaries' => [
        'npm' => env('NPM_BINARY_PATH', trim(shell_exec('which npm') ?? '')),
        'node' => env('NODE_BINARY_PATH', trim(shell_exec('which node') ?? '')),
        'chrome' => env(
            'CHROME_BINARY_PATH',
            collect([
                trim(shell_exec('npm list -g | head -1') ?? ''),
                'node_modules/puppeteer/.local-chromium/linux-950341/chrome-linux',
            ])->implode(DIRECTORY_SEPARATOR)
        ),
    ],

    'paths' => [
        'node_modules' => env(
            'NODE_MODULES_PATH',
            collect([
                trim(shell_exec('npm list -g | head -1') ?? ''),
                'node_modules',
            ])->implode(DIRECTORY_SEPARATOR)
        ),
    ],
];
