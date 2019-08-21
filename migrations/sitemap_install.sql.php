<? /** Create the Sitemap Module Table */ ?>

<?
/**
 * Sitemap Install
 */


return [
    /**
     * Database Drop
     */
    'DROP TABLE IF EXISTS `sitemaps`',

    /**
     * Table structure for table `sitemaps`
     */
    'CREATE TABLE `sitemaps` (
      `sid` int(11) NOT NULL,
      `sitemap_name` varchar(256) NOT NULL,
      `sitemap_machine` varchar(256) NOT NULL,
      `sitemap_namespace` varchar(256) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;',

    /**
     * Indexes for table `sitemaps`
     */
    'ALTER TABLE `sitemaps` ADD PRIMARY KEY (`sid`);',

    /**
     * AUTO_INCREMENT for table `sitemaps`
     */
    'ALTER TABLE `sitemaps` MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT;'
];