<?php

require (dirname(__FILE__).'/../config.inc.php');

require (PATH_CLASSES.'Auto/schema.php');

$db = DBPool::me()->getLink();

$sql = $schema->toDialectString(PostgresDialect::me());

if (in_array('-i', $argv)) {
    $db->queryRaw($sql);
} else {
    echo $sql;
}
