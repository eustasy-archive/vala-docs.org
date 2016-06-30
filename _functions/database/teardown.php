<?php

require_once __DIR__."/connection.php";
require_once __DIR__."/tables.php";

//
// Destruction function
//
function database_teardown(PDO $connection = null) {
	global $database;

	if (!$connection) {
		$connection = $database["connection"];
	}

	foreach ($database["tables"] as $table => $data) {
		$query_string = "DROP TABLE IF EXISTS $table";

		$query = $connection->prepare($query_string);

		if (!$query->execute()) {
			printf("Unable to drop $table table. Perhaps it doesn't exist?\n");
		}
	}
}
