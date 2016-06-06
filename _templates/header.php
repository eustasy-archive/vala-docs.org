<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta name="theme-color" content="#403757">

        <title><?php echo isset($page['title']) ? $page['title'] . ' &sdot; ' : false ; ?>vala-docs</title>
        <meta name="apple-mobile-web-app-title" content="vala-docs">

        <meta name="description" content="The canonical source for Vala API references.">

        <link rel="shortcut icon" href="/assets/images/site/favicon.ico">
        <link rel="apple-touch-icon" href="/assets/images/site/favicon.png">
        <link rel="icon" type="image/png" href="/assets/images/site/favicon.png" sizes="256x256">
        <link rel="manifest" href="/assets/manifest.json">

        <link rel="stylesheet" type="text/css" media="all" href="/assets/styles/main.css">

        <?php echo !empty($page['scripts']) ? $page['scripts'] : false ; ?>
    </head>
    <body>
        <header>
            <div class="search">
                <input type="text" placeholder="Search">
            </div>
            <div class="branding">
                <div js-toggle=".sidebar .search .links">&#9776;</div>
                <a href="/">
                    <img src="/assets/images/site/logo.svg" alt="vala logo">
                </a>
                <span>Stays crunchy, even in milk.</span>
            </div>
            <ul class="links">
                <a href="/tutorial"><li>Tutorial</li></a>
                <a href="https://github.com/eustasy/vala-docs.org"><li>GitHub</li></a>
            </ul>
        </header>
        <main>
