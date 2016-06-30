<?php

require_once __DIR__."/../_settings/docs.php";
require_once __DIR__."/../_functions/database/setup.php";
require_once __DIR__."/../_functions/database/teardown.php";
require_once __DIR__."/../_functions/database/create.php";

//
// Setup
//

// Grab command line comments for easy access
$args = getopt("fv", ["force", "verbose"]);
$args["force"] = (isset($args["f"]) || isset($args["force"]));
$args["verbose"] = (isset($args["v"]) || isset($args["verbose"]));

// Optional drop database if using -f or --force
if ($args["force"]) {
	printf("Dropping the database. wubwubwub...\n");
	database_teardown();
}

// Setup all our tables if need be
database_setup();

// Setup stats so we have something to exit with
$stats = [
	"packages" => 0,
	"namespaces" => 0,
	"classes" => 0
];

//
// Per tag functions for creating database objects
//
function build_class(SimpleXMLElement $node, $package) {
	global $args;
	global $stats;

	$attr = $node->attributes();
	$id = $attr->id;

	$obj = [
		"id" => $id,
		"name" => $attr->name,
		"package" => $package,
		"deprecated" => $attr->deprecated,
		"visibility" => $attr->visibility,
		"abstract" => $attr->abstract,
		"compact" => $attr->compact,
		"fundamental" => $attr->fundamental,
		"parent_bases" => [],
		"parent_interfaces" => [],
		"attributes" => []
	];

	if (isset($node->parents) || array_key_exists("parents", $node)) {
		foreach ($node->parents[0] as $name => $value) {
			if ($name === "base_type") {
				$obj["parent_bases"][] = $value;
			} else if ($name === "parent_interface") {
				$obj["parent_interfaces"][] = $value;
			}
		}
	}

	if (isset($node->attributes) || array_key_exists("attributes", $node)) {
	 	foreach ($node->attributes[0] as $tag => $value) {
			$obj["attributes"][] = $value;
		}
  	}

	$obj["parent_bases"] = "{".implode(", ", $obj["parent_bases"])."}";
	$obj["parent_interfaces"] = "{".implode(", ", $obj["parent_interfaces"])."}";
	$obj["attributes"] = "{".implode(", ", $obj["attributes"])."}";

	$r = database_create('classes', $obj);
	if (!$r && $args["verbose"]) printf("Unable to create $id class.\n");
	if ($r) $stats["classes"] += 1;

	build_next($node, $package);
}

//
// Director function for iterating over the unknown
//
function build_next(SimpleXMLElement $node, $package) {
	if (!isset($node->members) && !array_key_exists("memebers", $node)) return;

	if (isset($node->members->class) || array_key_exists("class", $node->members)) {
		foreach ($node->members->class as $class) {
			build_class($class, $package);
		}
	}
}

//
// Start building the rows
//
$files = array_diff(scandir($settings["docs"]["directory"]), ["..", "."], $settings["docs"]["blacklist"]);

foreach ($files as $packagefile) {
	try {
		if (!$args["verbose"]) {
			libxml_clear_errors();
			libxml_use_internal_errors(true);
		}

		$xml = simplexml_load_file($settings["docs"]["directory"]."/".$packagefile);
	} catch (Exception $e) {
		printf("Unable to open $packagefile. Continuing to next package file\n");
		continue;
	}

	if ($xml === false) {
		printf("Unable to open $packagefile. Continuing to next package file\n");
		continue;
	}

	$package = $xml->attributes()->name;

	$r = database_create('packages', [
		"name" => $package
	]);
	if (!$r && $args["verbose"]) {
		printf("Unable to create $package package.\n");
	}
	if ($r) $stats["packages"] += 1;

	foreach ($xml->namespace as $namespaceRaw) {
		$namespace = $namespaceRaw->attributes()->id;

		$r = database_create('namespaces', [
			"id" => $namespace,
			"name" => $namespaceRaw->attributes()->name,
			"package" => $package,
			"deprecated" => $namespaceRaw->attributes()->deprecated,
			"visibility" => $namespaceRaw->attributes()->visibility
		]);
		if (!$r && $args["verbose"]) {
			printf("Unable to create $namespace namespace.\n");
		}

		if ($r) $stats["namespaces"] += 1;
		build_next($namespaceRaw, $package);
	}
}

//
// Report card time
//
printf("database.php complete!\n");

if ($args["verbose"]) {
	printf("database updates:\n");

	foreach ($stats as $name => $value) {
		printf("$name => $value\n");
	}
}

exit(0);
