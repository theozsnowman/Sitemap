<?php
/**
 * @package   WarpKnot
 */

/**
 * Admin Menu
 */
return [
    600 => [
        'sitemap_management' => [
            'name'  => 'Sitemaps',
            'link'  => 'admin/sitemaps',
            'icon'  => 'oi oi-rss',
            'roles' => [
                'administrator'
            ],
            'items' => [
                'sitemap'     => [
                    'name'  => 'Sitemaps',
                    'link'  => 'admin/sitemaps',
                    'icon'  => 'oi oi-rss',
                    'roles' => [
                        'administrator'
                    ],
                ],
                'sitemap_add' => [
                    'name'  => 'Add Sitemap',
                    'link'  => 'admin/sitemaps/add',
                    'icon'  => 'oi oi-plus',
                    'roles' => [
                        'administrator'
                    ],
                ],
            ]
        ]
    ]
];