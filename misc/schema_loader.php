<?php

require (dirname(__FILE__).'/../config.inc.php');

require (PATH_CLASSES.'Auto/schema.php');

$db = DBPool::me()->getLink();

$db->queryRaw(
	$schema->toDialectString(PostgresDialect::me())
);
