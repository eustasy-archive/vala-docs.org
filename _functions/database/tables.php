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

$database["tables"]["methods"] = [
	"id" => "varchar(128) NOT NULL PRIMARY KEY",
	"name" => "varchar(50) NOT NULL",
	"package" => "varchar(128) NOT NULL",
	"deprecated" => "boolean DEFAULT false",
	"visibility" => "varchar(9) DEFAULT 'public'",
	"abstract" => "boolean DEFAULT false",
	"dbus_visible" => "boolean DEFAULT true",
	"inline" => "boolean DEFAULT false",
	"override" => "boolean DEFAULT false",
	"static" => "boolean DEFAULT false",
	"virtual" => "boolean DEFAULT false",
	"yields" => "boolean DEFAULT false",
	"return_type" => "varchar(128)",
	"returns_array" => "boolean DEFAULT false",
	"attributes" => "varchar(128)[]"
];

$database["tables"]["properties"] = [
	"id" => "varchar(128) NOT NULL PRIMARY KEY",
	"name" => "varchar(50) NOT NULL",
	"package" => "varchar(128) NOT NULL",
	"deprecated" => "boolean DEFAULT false",
	"visibility" => "varchar(9) DEFAULT 'public'",
	"abstract" => "boolean DEFAULT false",
	"dbus_visible" => "boolean DEFAULT true",
	"override" => "boolean DEFAULT false",
	"virtual" => "boolean DEFAULT false",
	"getter_visibility" => "varchar(9) DEFAULT 'public'",
	"getter_get" => "boolean DEFAULT true",
	"setter_visibility" => "varchar(9) DEFAULT 'public'",
	"setter_set" => "boolean DEFAULT true",
	"setter_construct" => "boolean DEFAULT false",
	"attributes" => "varchar(128)[]"
];
