<?php
/**
 * @package   WarpKnot
 */

namespace _MODULE\Sitemap;

use _MODULE\_DB;
use _WKNT\_INIT;
use _WKNT\_PAGINATION;
use _WKNT\_REQUEST;
use _WKNT\_ROUTE;

/**
 * Class Admin
 * @package _MODULE\Sitemap
 */
class Admin extends _INIT
{
    private static $module = 'Sitemap\Admin',
        $moduleTemplate = 'Dashboard',
        $templatesDirectory = 'Sitemap';

    /**
     * Generate the dashboard template
     *
     * @param $page
     */
    private static function template($page)
    {
        self::$_VRS = [
            'header'  => selfRender(self::$moduleTemplate, 'partials/header.php'),
            'footer'  => selfRender(self::$moduleTemplate, 'partials/footer.php'),
            'content' => selfRender(self::$templatesDirectory, $page)
        ];
    }

    /**
     * Add a new Sitemap
     */
    public static function getAddAction()
    {
        global $_TRANSLATION;

        $objects               = new _DB\RoutingSystem();
        $objects->connSettings = [
            'select' => '`namespace`',
        ];

        self::$_VIEW->objects          = $objects->distinct();
        self::$_VIEW->menu             = 'sitemap_management';
        self::$_VIEW->sMenu            = 'sitemap_add';
        self::$_VIEW->page_title       = $_TRANSLATION['sitemap']['add']['seo_title'];
        self::$_VIEW->page_description = $_TRANSLATION['sitemap']['add']['seo_description'];

        self::template('admin/sitemap.php');
    }

    /**
     * All Sitemaps
     */
    public static function getAllAction()
    {
        global $_TRANSLATION, $_APP_CONFIG;

        $_GET_VARIABLES = _REQUEST::_GET_VARIABLES();
        $filter         = [];

        if (isset($_GET_VARIABLES['sitemap_name']) && !empty($_GET_VARIABLES['sitemap_name'])):
            $filter['sitemap_name'] = [
                'type'  => 'like',
                'value' => '%' . $_GET_VARIABLES['sitemap_name'] . '%'
            ];
        endif;

        $objects     = new _DB\Sitemaps();
        $objectsList = $objects->search(
            [
                'fields' => $filter,
                'sort'   => [
                    'sid' => 'desc'
                ]
            ]);

        self::$_VIEW->objects = _PAGINATION::_GENERATE(
            [
                '_HASHTAG'        => $_APP_CONFIG['_DOMAIN_ROOT'] . 'admin/sitemaps',
                '_PAGE_LINK'      => $_APP_CONFIG['_DOMAIN_ROOT'] . 'admin/sitemaps',
                '_CURRENT_PAGE'   => _PAGINATION::_CURRENT_PAGE(),
                '_TOTAL_ITEMS'    => count($objectsList),
                '_ITEMS_PER_PAGE' => $_APP_CONFIG['pagination_limit'],
                '_ITEMS'          => $objectsList
            ]
        );

        /**
         * Check the delete request
         */
        $delete = null;
        if (isset($_GET_VARIABLES['delete'])):
            $object = new _DB\Sitemaps();
            $delete = $object->search(
                [
                    'fields' => [
                        'sid' => [
                            'type'  => '=',
                            'value' => $_GET_VARIABLES['delete']
                        ]
                    ]
                ]);
        endif;

        self::$_VIEW->delete           = $delete;
        self::$_VIEW->menu             = 'sitemap_management';
        self::$_VIEW->sMenu            = 'sitemap';
        self::$_VIEW->page_title       = $_TRANSLATION['sitemap']['list']['seo_title'];
        self::$_VIEW->page_description = $_TRANSLATION['sitemap']['list']['seo_description'];

        self::template('admin/sitemaps.php');
    }


    /**
     * Sitemap Update
     */
    public static function getEditAction()
    {
        global $_TRANSLATION;
        $_REQUEST_ID = _REQUEST::_REQUEST_ID();
        $_PID        = $_REQUEST_ID[0];

        $object = new _DB\Sitemaps();
        $object = $object->search(
            [
                'fields' => [
                    'sid' => [
                        'type'  => '=',
                        'value' => $_PID
                    ]
                ]
            ]);

        if (empty($object)):
            _ROUTE::_REDIRECT('admin/sitemaps');
        endif;
        self::$_VIEW->object = $object[0];

        $objects               = new _DB\RoutingSystem();
        $objects->connSettings = [
            'select' => '`namespace`',
        ];

        self::$_VIEW->objects          = $objects->distinct();
        self::$_VIEW->menu             = 'sitemap_management';
        self::$_VIEW->sMenu            = 'sitemap_update';
        self::$_VIEW->page_title       = $_TRANSLATION['sitemap']['edit']['seo_title'];
        self::$_VIEW->page_description = $_TRANSLATION['sitemap']['edit']['seo_description'];

        self::template('admin/sitemap.php');
    }

}