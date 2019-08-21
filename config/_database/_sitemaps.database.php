<?php
/**
 * @package   WarpKnot
 */

/**
 * Database connection for default plugin
 */

namespace _MODULE\_DB;

use _WKNT\_CRUD;

class Sitemaps Extends _CRUD
{
    //:: Table name
    protected $table = 'sitemaps';

    //:: Primary key
    protected $key = 'sid';
}
