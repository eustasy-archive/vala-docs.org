<?php

if (!isset($database)) $database = [];
if (!isset($database["tables"])) $database["tables"] = [];

$database["tables"]["packages"] = [
	"name" => "varchar(128) NOT NULL PRIMARY KEY"
];

$database["tables"]["namespaces"] = [
	"id" => "varchar(128) NOT NULL PRIMARY KEY",
	"name" => "varchar(50) NOT NULL UNIQUE",
	"package" => "varchar(128) NOT NULL",
	"deprecated" => "boolean DEFAULT false",
	"visibility" => "varchar(9) DEFAULT 'public'"
];

$database["tables"]["classes"] = [
	"id" => "varchar(128) NOT NULL PRIMARY KEY",
	"name" => "varchar(50) NOT NULL",
	"package" => "varchar(128) NOT NULL",
	"deprecated" => "boolean DEFAULT false",
	"visibility" => "varchar(9) DEFAULT 'public'",
	"abstract" => "boolean DEFAULT false",
	"compact" => "boolean DEFAULT false",
	"fundamental" => "boolean DEFAULT false",
	"parent_bases" => "varchar(128)[]",
	"parent_interfaces" => "varchar(128)[]",
	"attributes" => "varchar(128)[]"
];
