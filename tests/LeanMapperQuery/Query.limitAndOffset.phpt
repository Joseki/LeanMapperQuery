<?php

/**
 * Test: LeanMapperQuery\Query limit and offset.
 * @author Michal Bohuslávek
 */

use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

const LIMIT = 10;
const OFFSET = 50;

$fluent = getQuery()->applyQuery(getFluent('book'), $mapper);
Assert::same('SELECT [book].* FROM [book]', (string) $fluent);

$fluent2 = getQuery()->limit(LIMIT)->applyQuery(getFluent('book'), $mapper);
Assert::same('  SELECT [book].* FROM [book] LIMIT 10', (string) $fluent2);

$fluent = getFluent('book');
getQuery()
	->limit(LIMIT)
	->offset(OFFSET)
	->applyQuery($fluent, $mapper);

Assert::same('  SELECT [book].* FROM [book] LIMIT 10 OFFSET 50', (string) $fluent);
