<?php
return [
    'title' => 'Citykid Page Attributes',
    'id' => 'citykid-page-attributes',
    'post_types' => ['page'],
    'context' => 'side',
    'priority' => 'high',
    'default_hidden' => false,
    'fields' => [
        [
            'type' => 'custom_html',
            'desc' => 'Attribute settings options displayed in the <a href="#citykid-page-data"><strong>Citykid Page Data</strong></a>.',
        ],        
        [
            'id' => 'disable_header',
            'type' => 'checkbox',
            'desc' => 'Disable Header?',           
            'std' => false
        ],
        [
            'id' => 'disable_topbar',
            'type' => 'checkbox',
            'desc' => 'Disable Topbar?',           
            'std' => false,
            'hidden' => [ 'disable_header', '=', true ],
        ],
        [
            'id' => 'tra_header',
            'type' => 'checkbox',
            'desc' => esc_attr__('Transparent Header', 'citykid'),
            'hidden' => [ 'disable_header', '=', true ]
        ],        
        [
            'id' => 'disable_banner',
            'type' => 'checkbox',
            'desc' => 'Disable Banner',
            'std' => false,
        ],       
        
        [
            'id' => 'disable_breadcrumbs',
            'type' => 'checkbox',
            'desc' => 'Disable breadcrumbs',               
            'std' => false, 
        ], 
        [
            'id' => 'container',
            'type' => 'select',
            'name' => 'Page Container',         
            'desc' => 'Page container style', 
            'std' => 'container',
            'options' => [
                'container' => 'Container',
                'container-fluid' => 'Container Fluid',
                'container-full' => 'Container Full-width',
            ],        
        ],  
        [
            'id' => 'spacer_y',
            'type' => 'select',
            'name' => 'Vertical Spacer',         
            'desc' => 'Page container top:bottom spacer(in pixel) style', 
            'std' => 'py-100',       
        ],
        [
            'id' => 'layout',
            'type' => 'image_select',
            'name' => 'Page layout', 
            'inline' => false,        
            'std' => 'rs',
            'options' => [
                'full' => CITYKID_ASSETS .'/layout/full-width.png',
                'ls' => CITYKID_ASSETS .'/layout/left-sidebar.png',
                'rs' => CITYKID_ASSETS .'/layout/right-sidebar.png',
            ],        
        ], 
        [
            'id' => 'sidebar',
            'type' => 'select',
            'name' => 'Sidebar',         
            'std' => 'sidebar-page',  
            'visible' => ['layout', '!=', 'full'] 
        ],         
        [
            'id' => 'custom_footer_settings',
            'type' => 'checkbox',
            'desc' => 'Disable footer?',         
        ],
        
    ],
];