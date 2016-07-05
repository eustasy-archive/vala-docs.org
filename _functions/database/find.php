<?php

require_once __DIR__."/connection.php";

function database_find($table, $doc = [], PDO $connection = null) {
	global $database;

	if (!$connection) {
		$connection = $database["connection"];
	}

	$query_string = "SELECT * FROM $table";

	if (count($doc) > 0) {
		$query_string .= " WHERE ";
	}

	foreach ($doc as $field => $data) {
		if (substr($data, 0, 1) === "^") {
			$query_string .= "$field ~ '$data', ";
		} else {
			$query_string .= " $field = '$data', ";
		}
	}

	$query_string = rtrim($query_string, ", ");

	$query = $connection->prepare($query_string);
	$query->execute();
	return $query->fetchAll();
}
