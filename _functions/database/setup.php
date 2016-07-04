<?php

require_once __DIR__."/connection.php";
require_once __DIR__."/tables.php";

//
// Creation function
//
function database_setup(PDO $connection = null) {
	global $database;

	if (!$connection) {
		$connection = $database["connection"];
	}

	foreach ($database["tables"] as $table => $data) {
		$query_string = "CREATE TABLE IF NOT EXISTS $table (";

		foreach ($data as $field => $params) {
			$query_string .= "$field $params, ";
		}

		$query_string = rtrim($query_string, ", ").")";
		$query = $connection->prepare($query_string);

		if (!$query->execute()) {
			printf("Unable to create $table table. Perhaps it already exists?\n");
		}
	}
}
