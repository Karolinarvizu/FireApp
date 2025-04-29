<?php

return [

    'asset_url' => env('ASSET_URL', null),

    'build_directory' => '../public_html/build',

    'hot_file' => env('VITE_HOT_FILE', storage_path('app/vite.hot')),

    'dev_server_url' => env('VITE_DEV_SERVER_URL', 'http://localhost:5173'),

    'additional_entrypoints' => [],
];
