--TEST--
MySQL PDO->mysqlGetWarningCount()
--SKIPIF--
<?php
require_once(__DIR__ . DIRECTORY_SEPARATOR . 'skipif.inc');
require_once(__DIR__ . DIRECTORY_SEPARATOR . 'mysql_pdo_test.inc');
MySQLPDOTest::skip();
?>
--FILE--
<?php
	require_once(__DIR__ . DIRECTORY_SEPARATOR . 'mysql_pdo_test.inc');
	$db = MySQLPDOTest::factory();

	try {
		$db->query('SELECT 1 = 1');
		if (0 !== ($count = $db->mysqlGetWarningCount()))
			printf("[002] Expecting 0 got %s", var_export($count, true));

		$db->query('SELECT 1 = "A"');
		if (1 !== ($count = $db->mysqlGetWarningCount()))
			printf("[003] Expecting 1 got %s", var_export($count, true));

	} catch (PDOException $e) {
		printf("[001] %s [%s] %s\n",
			$e->getMessage(), $db->errorCode(), implode(' ', $db->errorInfo()));
	}

	print "done!";
?>
--EXPECT--
done!
