<?php

return [
    'mode' => '',
    'format' => 'A4',
    'default_font_size' => '12',
    'default_font' => 'bangla',
    'margin_left' => 10,
    'margin_right' => 10,
    'margin_top' => 10,
    'margin_bottom' => 10,
    'margin_header' => 0,
    'margin_footer' => 0,
    'orientation' => 'L',
    'title' => 'Laravel mPDF',
    'subject' => '',
    'author' => '',
    'watermark' => '...',
    'show_watermark' => false,
    'show_watermark_image' => false,
    'watermark_font' => 'bangla',
    'display_mode' => 'fullpage',
    'watermark_text_alpha' => 0.02,
    'watermark_image_path' => '',
    'watermark_image_alpha' => 0.03,
    'watermark_image_size' => 'D',
    'watermark_image_position' => 'P',
    'custom_font_dir' => resource_path('fonts/'), // don't forget the trailing slash!
    'custom_font_data' => [
        'bangla' => [
            // must be lowercase and snake_case
            'R' => 'kalpurush.ttf',
            'useOTL' => 0x00,
            'useKashida' => 75,
        ],
        'dflix' => [
            'R' => 'dflix.ttf',
            'useOTL' => 0x00,
            'useKashida' => 75,
        ],
        'flex' => [
            'R' => 'flex.ttf',
            'useOTL' => 0x00,
            'useKashida' => 75,
        ],
    ],
    'auto_language_detection' => false,
    'temp_dir' => storage_path('app'),
    'pdfa' => false,
    'pdfaauto' => false,
    'use_active_forms' => false,
    'autoLangToFont' => true,
];
