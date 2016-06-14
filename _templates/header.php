<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta name="theme-color" content="#403757">

        <title><?php echo isset($page["title"]) ? $page["title"] . " &sdot; " : false ; ?><?php echo $page["subtitle"]; ?></title>
        <meta name="apple-mobile-web-app-title" content="vala-docs">

        <meta name="description" content="<?php echo $page["description"]; ?>">

        <link rel="shortcut icon" href="/assets/images/site/favicon.ico">
        <link rel="apple-touch-icon" href="/assets/images/site/favicon.png">
        <link rel="icon" type="image/png" href="/assets/images/site/favicon.png" sizes="256x256">
        <link rel="manifest" href="/assets/manifest.json">

        <link rel="stylesheet" type="text/css" media="all" href="/assets/styles/main.css">

        <?php echo !empty($page["scripts"]) ? $page["scripts"] : false ; ?>
    </head>
    <body>
        <nav class="sidebar">
            <a href="/">
                <img src="/assets/images/site/logo.svg" alt="vala logo" height="42px" width="121.75px">
            </a>
            <div class="search">
                <input type="text" placeholder="Search">
            </div>
            <ul>
                <?php
                    foreach($page["sidebar"] as $sub) {
                        echo "<ul>";

                        foreach($sub as $item) {
                            echo $item;
                        }

                        echo "</ul>";
                    }
                ?>
            </ul>
        </nav>
        <main>
            <header>
                <div class="sidebar-menu">&#9776;</div>
                <a href="/">
                    <img src="/assets/images/site/logo.svg" alt="vala logo" height="42px" width="121.75px">
                </a>
            </header>