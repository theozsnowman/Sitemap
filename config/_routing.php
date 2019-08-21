<?php
/**
 * @package   WarpKnot
 */

/**
 * Sitemap routing system
 *
 * Static route e.g. /example/list
 *
 */
return [
    /**
     * @administration
     */

    /**
     * Management - Private
     */
    'admin/sitemaps/post'       => [
        'module'         => 'Sitemap',
        'namespace'      => 'Sitemap',
        'action'         => 'Management',
        'type'           => 'static',
        'methods'        => [
            'post'
        ],
        'required_roles' => [
            'administrator'
        ],
        'redirect_page'  => '',
        'local_template' => false
    ],

    /**
     * Available Sitemaps
     */
    'admin/sitemaps'            => [
        'module'         => 'Sitemap',
        'namespace'      => 'Sitemap\Admin',
        'action'         => 'All',
        'type'           => 'static',
        'methods'        => [
            'get'
        ],
        'required_roles' => [
            'administrator'
        ],
        'local_template' => true
    ],

    /**
     * Add Sitemap
     */
    'admin/sitemaps/add'        => [
        'module'         => 'Sitemap',
        'namespace'      => 'Sitemap\Admin',
        'action'         => 'Add',
        'type'           => 'static',
        'methods'        => [
            'get'
        ],
        'required_roles' => [
            'administrator'
        ],
        'local_template' => true
    ],

    /**
     * Sitemap Update
     */
    'admin/sitemaps/edit/{var}' => [
        'module'         => 'Sitemap',
        'namespace'      => 'Sitemap\Admin',
        'action'         => 'Edit',
        'type'           => 'dynamic',
        'variables'      => [
            '{id}',
        ],
        'methods'        => [
            'get'
        ],
        'required_roles' => [
            'administrator'
        ],
        'local_template' => true
    ],

    /**
     * Sitemaps List
     */
    'sitemap.xml'        => [
        'module'         => 'Sitemap',
        'namespace'      => 'Sitemap\_SITEMAP_XML',
        'action'         => 'Sitemaps',
        'type'           => 'static',
        'methods'        => [
            'get'
        ],
        'local_template' => false
    ],

    /**
     * Sitemap XML
     */
    'sitemap/{var}'         => [
        'module'         => 'Sitemap',
        'namespace'      => 'Sitemap\_SITEMAP_XML',
        'action'         => 'GenerateSitemap',
        'type'           => 'dynamic',
        'variables'      => [
            '{id}',
        ],
        'methods'        => [
            'get'
        ],
        'local_template' => false
    ],
];