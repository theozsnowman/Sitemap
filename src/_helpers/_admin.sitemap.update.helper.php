<?php
/**
 * @package   WarpKnot
 */

namespace _MODULE\Sitemap\Admin;

use _MODULE\_DB;
use _WKNT\_REQUEST;
use _WKNT\_SANITIZE;
use function json_encode;

/**
 * Class _SITEMAP_UPDATE
 * @package _MODULE\Sitemap\Admin
 */
class _SITEMAP_UPDATE
{

    /**
     * Sitemap Update
     */
    public static function execute()
    {
        global $_TRANSLATION;

        $variables = _REQUEST::_VARIABLES(_REQUEST::_POST()['data']);

        $errors = _REQUEST::_VALIDATE(
            [
                'sitemap_name'    => ['not_empty'],
                'sitemap_machine' => ['not_empty'],
                'namespace'       => ['not_empty']
            ], $variables);

        if (empty($errors)):

            /**
             * Update your Sitemap
             */
            $variables['sitemap_machine']    = _SANITIZE::slug($variables['sitemap_machine']);
            $slugCount                       = self::slugCount($variables['sitemap_machine'], $variables['sid']);
            $slug                            = ($slugCount > 0) ? $variables['sitemap_machine'] . '-' . ($slugCount - 1) : $variables['sitemap_machine'];
            $objectUpdate                    = new _DB\Sitemaps();
            $objectUpdate->sitemap_name      = $variables['sitemap_name'];
            $objectUpdate->sitemap_machine   = $slug;
            $objectUpdate->sitemap_namespace = $variables['namespace'];
            $objectUpdate->save($variables['sid']);

            return json_encode(
                [
                    'errors'  => false,
                    'message' => [
                        'type' => 'success',
                        'text' => $_TRANSLATION['sitemap']['updated']
                    ]
                ]
            );

        else:
            return json_encode(
                [
                    'errors'   => $errors,
                    'message'  => [
                        'type' => 'danger',
                        'text' => $_TRANSLATION['sitemap']['errors']
                    ],
                    'redirect' => false
                ]
            );
        endif;
    }

    /**
     * @param $slug
     * @param $id
     *
     * @return int
     */
    private static function slugCount($slug, $id)
    {

        /**
         * Validate the Sitemap slug
         */
        $object       = new _DB\Sitemaps();
        $slugValidate = $object->search(
            [
                'fields' => [
                    'sitemap_machine' => [
                        'type'  => '=',
                        'value' => $slug
                    ],
                    'condition'       => [
                        'value' => 'and'
                    ],
                    'sid'             => [
                        'type'  => '!=',
                        'value' => $id
                    ]
                ]
            ]
        );

        $objectNumber = 0;
        while (!empty($slugValidate)) {
            $object       = new _DB\Sitemaps();
            $slugValidate = $object->search(
                [
                    'fields' => [
                        'sitemap_machine' => [
                            'type'  => '=',
                            'value' => $slug . '-' . $objectNumber
                        ],
                        'condition'       => [
                            'value' => 'and'
                        ],
                        'sid'             => [
                            'type'  => '!=',
                            'value' => $id
                        ]
                    ]
                ]
            );
            $objectNumber++;
        }

        return $objectNumber;
    }
}