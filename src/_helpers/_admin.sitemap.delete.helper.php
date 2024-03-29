<?php
/**
 * @package   WarpKnot
 */

namespace _MODULE\Sitemap\Admin;

use _WKNT\_CRUD;
use _WKNT\_MESSAGE;
use _WKNT\_REQUEST;
use function json_encode;

/**
 * Class _SITEMAP_DELETE
 * @package _MODULE\Sitemap\Admin
 */
class _SITEMAP_DELETE
{

    /**
     * Sitemap Delete
     */
    public static function execute()
    {
        global $_TRANSLATION, $_APP_CONFIG;

        $variables = _REQUEST::_VARIABLES(_REQUEST::_POST()['data']);
        $sid       = $variables['sid'];

        /**
         * Delete from the default tables
         */
        $del           = new _CRUD();
        $defaultTables = [
            'sitemaps' => [
                'key'   => 'sid',
                'value' => $sid
            ]
        ];

        foreach ($defaultTables as $key => $table):
            $del->deleteFrom($key, $table['key'], $table['value']);
        endforeach;

        _MESSAGE::set($_TRANSLATION['sitemap']['removed'], 'success');

        return json_encode(
            [
                'errors'   => '',
                'message'  => false,
                'redirect' => $_APP_CONFIG['_DOMAIN_ROOT'] . 'admin/sitemaps'
            ]
        );

    }
}