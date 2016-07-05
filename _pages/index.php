<?php

require_once __DIR__."/../_templates/sitewide.php";
require_once __DIR__."/../_functions/database/find.php";

$packages = database_find("packages");

$page["sidebar"][] = array_map(function($package) {
	return '<a href="/'.$package["name"].'"><li class="package">'.$package["name"].'</li></a>';
}, $packages);

include $templates["header"];

$package_count = count($packages);
$namespace_count = $database["connection"]->query("SELECT count(*) FROM namespaces")->fetchColumn();
$class_count = $database["connection"]->query("SELECT count(*) FROM classes")->fetchColumn();

?>

<section class="content">
    <h1>Homepage</h1>

	<div class="wrapper">
		<h3>Statistics</h3>
		<p>
			vala-docs currently has
			<b><?php echo $package_count; ?></b> packages,
			<b><?php echo $namespace_count; ?></b> namespaces, and
			<b><?php echo $class_count; ?></b> classes.
		</p>
	</div>
</section>

<?php
    include $templates["footer"];
