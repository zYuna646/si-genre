<?php

return [
    'default_paper_size' => 'a4',
    'font_dir' => storage_path('fonts/'),
    'font_cache' => storage_path('fonts/'),
    'chroot' => realpath(base_path()),
    'allowed_protocols' => [
        'file://' => [
            'rules' => [],
        ],
        'http://' => [
            'rules' => [],
        ],
        'https://' => [
            'rules' => [],
        ],
    ],
    'log_output_file' => null,
    'options' => [
        'font_dir' => storage_path('fonts/'),
        'font_cache' => storage_path('fonts/'),
        'default_font' => 'sans-serif',
        'enable_font_subsetting' => false,
        'pdf_backend' => 'CPDF',
        'default_paper_size' => 'a4',
        'default_font_size' => 12,
        'dpi' => 96,
        'enable_php' => true,
        'enable_javascript' => true,
        'enable_remote' => true,
        'font_height_ratio' => 1.1,
        'enable_html5_parser' => true,
    ],
];