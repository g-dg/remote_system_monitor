<?php

define('GARNETDG_MONITOR_VERSION', '1.0.0');

require('common.php');

if (!isset($_GET['action'])) {
	http_response_code(400);
	exit('No action specified.');
}

switch ($_GET['action']) {

	case 'get_status_all':
		$systems = [];

		$system_stmt = $db->prepare('SELECT "id", "name" FROM "systems" ORDER BY "name";');
		$system_stmt->execute();
		$systems_res = $system_stmt->fetchAll();

		$ping_stmt = $db->prepare('SELECT "timestamp", "loadavg" FROM "pings" WHERE "system_id" = ? ORDER BY "timestamp" DESC LIMIT 1;');

		foreach($systems_res as $system) {
			$online = false;
			$loadavg = null;
			$last_ping = null;

			$ping_stmt->execute([$system['id']]);
			$pings = $ping_stmt->fetchAll();

			if (isset($pings[0])) {
				if (time() - $pings[0]['timestamp'] < OFFLINE_WAIT) {
					$online = true;
					$loadavg = (float)$pings[0]['loadavg'];
				}
				$last_ping = date(DATE_ATOM, $pings[0]['timestamp']);
			}

			$systems[] = [
				'id' => (int)$system['id'],
				'name' => $system['name'],
				'online' => $online,
				'loadavg' => $loadavg,
				'last_ping' => $last_ping,
			];
		}

		header('Content-Type: application/json');
		echo json_encode($systems);

		break;


	default:
		http_response_code(400);
		exit('Invalid action specified.');
		break;

}
