<?php
require_once 'globals.php';

if ($dbh) {
    $dbh->exec('CREATE TABLE IF NOT EXISTS `files` (' .
        ' `id` INTEGER PRIMARY KEY AUTOINCREMENT,' .
        ' `name` TEXT NOT NULL' .
        ')');
    $dbh->exec('CREATE INDEX IF NOT EXISTS `filename` ON `files` (`name`)');
    echo "Table 'files' created.<br/>\n";

    $dbh->exec('CREATE TABLE IF NOT EXISTS `locations` (' .
        ' `id` INTEGER PRIMARY KEY AUTOINCREMENT,' .
        ' `userid` TEXT,' .
        ' `timestamp` INTEGER,' .
        ' `lat` REAL,' .
        ' `lng` REAL,' .
        ' `accuracy` INTEGER,' .
        ' `altitude` REAL,' .
        ' `altitudeaccuracy` INTEGER,' .
        ' `speed` REAL,' . 
        ' `heading` REAL,' .
        ' `file_id` INTEGER DEFAULT NULL REFERENCES files(id) ON UPDATE CASCADE ON DELETE SET DEFAULT' .
        ')');

    $dbh->exec('CREATE INDEX IF NOT EXISTS `userid` ON `locations` (`userid`)');
    $dbh->exec('CREATE INDEX IF NOT EXISTS `userid_timestamp` ON `locations` (`userid`, `timestamp` ASC)');
    $dbh->exec('CREATE INDEX IF NOT EXISTS `locations_timestamp` ON `locations` (`timestamp` DESC)');
    echo "Table 'locations' created.<br/>\n";

    $dbh->exec('CREATE TABLE IF NOT EXISTS `buddies` (' .
        ' `userid` TEXT PRIMARY KEY,' .
        ' `name` TEXT,' .
        ' `sharetracks` INTEGER DEFAULT 0,' .
        ' `avatar` TEXT' .
        ')');

    $dbh->exec('CREATE UNIQUE INDEX IF NOT EXISTS `userid_uniq` ON `buddies` (`userid`)');
    $dbh->exec('CREATE INDEX IF NOT EXISTS `name` ON `buddies` (`name`)');
    echo "Table 'buddies' created.<br/>\n";
    
}
?>
