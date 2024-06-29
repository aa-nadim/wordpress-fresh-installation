<?php
return [
        'title' => esc_attr__('Citykid Page Data', 'citykid'),
        'id' => 'citykid-page-data',
        'post_types' => ['page'],
        'context' => 'normal',
        'priority' => 'high',
        'default_hidden' => false,
        'fields' => [            
            [
                'id' => 'subtitle',
                'type' => 'textarea',
                'name' => esc_attr__('Subtitle', 'citykid'),
                'hidden' => [ 'disable_banner', '=', true ]
            ],
            [
                'id' => 'banner_image',
                'type' => 'image_advanced',
                'name' => esc_attr__('Banner image', 'citykid'),
                'max_file_uploads' => 1,
                'max_status'       => false,
                'image_size'       => 'thumbnail',
                'hidden' => [ 'disable_banner', '=', true ]
            ],
        
        ],
    ];