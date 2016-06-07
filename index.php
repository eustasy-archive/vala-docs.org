<?php

$requestUri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$requestExp = explode("/", $requestUri);

if ($requestUri == "/") {
    require __DIR__."/_pages/index.php";
} else if (strpos($requestUri, "_") === false && file_exists(".".$requestUri)) {
    return false;
} else if (count($requestExp) == 2) {
    require __DIR__."/_pages/package.php";
} else {
    require __DIR__."/_pages/404.php";
}
