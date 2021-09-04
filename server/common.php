<?php

if (!defined('GARNETDG_MONITOR_VERSION')) {
	http_response_code(403);
	die('Direct access not allowed!');
}

require('config.php');

// set up database connection
$db = new PDO('sqlite:' . DATABASE_FILE);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->exec('PRAGMA busy_timeout = 5000;');
$db->exec('PRAGMA journal_mode = WAL;');
$db->exec('PRAGMA synchronous = NORMAL;');
$db->exec('PRAGMA foreign_keys = ON;');


// create tables and indexes if they don't exist
$db->beginTransaction();

$db->exec('CREATE TABLE IF NOT EXISTS "systems" (
	"id" INTEGER PRIMARY KEY,
	"name" TEXT NOT NULL UNIQUE,
	"key" TEXT NOT NULL UNIQUE
);');

$db->exec('CREATE TABLE IF NOT EXISTS "pings" (
	"id" INTEGER PRIMARY KEY,
	"system_id" INTEGER NOT NULL REFERENCES "systems",
	"timestamp" INTEGER NOT NULL,
	"loadavg" REAL
);');

$db->exec('CREATE INDEX IF NOT EXISTS "idx_pings_systemId" ON "pings" ("system_id");');
$db->exec('CREATE INDEX IF NOT EXISTS "idx_pings_timestamp" ON "pings" ("timestamp");');

$db->commit();


// delete old ping records from database
$stmt = $db->prepare('DELETE FROM "pings" WHERE "timestamp" < ?;');
$stmt->execute([time() - PING_HISTORY_LENGTH]);

