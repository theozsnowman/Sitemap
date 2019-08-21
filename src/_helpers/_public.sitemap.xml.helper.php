<?php
/**
 * @package   WarpKnot
 */

namespace _MODULE\Sitemap;

use _MODULE\_DB;
use _WKNT\_INIT;
use _WKNT\_REQUEST;

/**
 * Class _SITEMAP_XML
 * @package _MODULE\Sitemap
 */
class _SITEMAP_XML extends _INIT
{
    private static $module = 'Sitemap';

    /**
     * Sitemaps
     */
    public static function getSitemapsAction()
    {
        header("Content-type: text/xml");
        $objects     = new _DB\Sitemaps();
        $objectsList = $objects->search();

        $sitemaps = [];
        if (!empty($objectsList)):
            foreach ($objectsList as $sitemap):
                self::$_VIEW->sitemap = $sitemap;
                $sitemaps[]           = selfRender(self::$module, 'public' . DIRECTORY_SEPARATOR . 'sitemap.item.php');
            endforeach;

            self::$_VIEW->sitemaps = $sitemaps;
            echo selfRender(self::$module, 'public' . DIRECTORY_SEPARATOR . 'sitemaps.php');
        endif;

    }

    /**
     * Sitemap
     */
    public static function getGenerateSitemapAction()
    {
        header("Content-type: text/xml");

        $_REQUEST_ID = _REQUEST::_REQUEST_ID();
        $_FIRST_ID   = isset($_REQUEST_ID[0]) ? $_REQUEST_ID[0] : '';
        $_SITEMAP    = substr_replace($_FIRST_ID, "", -4);

        if (!empty($_SITEMAP)):
            $object         = new _DB\Sitemaps();
            $sitemapDetails = $object->search(
                [
                    'fields' => [
                        'sitemap_machine' => [
                            'type'  => '=',
                            'value' => $_SITEMAP
                        ]
                    ]
                ]
            );
            if (!empty($sitemapDetails) && isset($sitemapDetails[0])):
                //Links List
                $objects     = new _DB\RoutingSystem();
                $objectsList = $objects->search(
                    [
                        'fields' => [
                            'namespace' => [
                                'type'  => '=',
                                'value' => $sitemapDetails[0]['sitemap_namespace']
                            ]
                        ]
                    ]
                );
                $links       = [];
                if (!empty($objectsList)):
                    foreach ($objectsList as $link):
                        self::$_VIEW->linkDetails = $link;
                        $links[]                  = selfRender(self::$module, 'public' . DIRECTORY_SEPARATOR . 'sitemap.link.php');
                    endforeach;
                endif;

                self::$_VIEW->links = $links;
                echo selfRender(self::$module, 'public' . DIRECTORY_SEPARATOR . 'sitemap.php');
            endif;
        endif;
    }
}