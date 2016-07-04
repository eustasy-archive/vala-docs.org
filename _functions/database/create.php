<?php

require_once __DIR__."/connection.php";

function database_create($table, $doc, PDO $connection = null) {
	global $database;

	if (!$connection) {
		$connection = $database["connection"];
	}

	if (isset($doc["id"]) || array_key_exists("id", $doc)) {
		$primary = "id";
	} else {
		$primary = "name";
	}

	$query_string = "INSERT INTO $table (";

	foreach ($doc as $field => $data) {
		$query_string .= "$field,";
	}

	$query_string = rtrim($query_string, ",").") VALUES (";

	foreach ($doc as $field => $data) {
		$query_string .= "'$data',";
	}

	$query_string = rtrim($query_string, ",").")";

	// upsert logic here
	if (count($doc) > 1) {
		$query_string .= " ON CONFLICT ($primary) DO update SET ";

		foreach ($doc as $field => $data) {
			if ($field === $primary) continue;

			$query_string .= "$field = '$data', ";
		}

		$query_string = rtrim($query_string, ", ");
	}

	$query = $connection->prepare($query_string);

	return $query->execute();
}
