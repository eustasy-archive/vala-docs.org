<?php

require_once __DIR__."/../../_settings/database.php";

if (!isset($database)) $database = [];

$database["error"] = false;

$host = $settings["database"]["host"];
$name = $settings["database"]["name"];

try {
	$database["connection"] = new PDO("pgsql:host='$host';dbname='$name'", $settings["database"]["user"], $settings["database"]["pass"]);
} catch (PDOException $e) {
	$database["error"] = $e->getMessage();
	error_log($database["error"]);
}
