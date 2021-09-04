<?php

define('GARNETDG_MONITOR_VERSION', '1.0.0');

require('common.php');


// check if client key is provided
if (!isset($_POST['key'])) {
	http_response_code(400);
	exit('Missing client key.');
}


// check if client exists
$stmt = $db->prepare('SELECT COUNT() FROM "systems" WHERE "key" = ?;');
$stmt->execute([$_POST['key']]);
$res = $stmt->fetchAll();

if ($res[0][0] < 1) {
	http_response_code(404);
	exit('Client key not found.');
}


// check if load average is provided
$loadavg = null;
if (isset($_POST['loadavg'])) {
	$loadavg = (float)$_POST['loadavg'];
}


// insert ping into database
$stmt = $db->prepare('INSERT INTO "pings" ("system_id", "timestamp", "loadavg") VALUES (?, ?, ?);');
$stmt->execute([$_POST['key'], time(), $loadavg]);


http_response_code(200);
exit();
