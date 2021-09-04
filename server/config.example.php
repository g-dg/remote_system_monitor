<?php

if (!defined('GARNETDG_MONITOR_VERSION')) {
	http_response_code(403);
	die('Direct access not allowed!');
}

// Database file
// Must be readable and writable by the web server process
// Must be in a directory that is readable and writable by the web server process
// Will be created if doesn't exist
define('DATABASE_FILE', './database.sqlite3');


// How long to keep pings in the database (in seconds)
define('PING_HISTORY_LENGTH', 86400);
