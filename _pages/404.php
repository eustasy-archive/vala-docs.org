<?php
    require_once __DIR__.'/../_templates/sitewide.php';

    header('HTTP/1.1 404 Not Found');

    include $templates['header'];
?>

<section class="content" id="404-error">
    <img src="/assets/images/icons/search.svg" />
    <h1>404</h1>
    <p>Page not found</p>
    <a href="/" class="btn btn-primary">Go Home</a>
</section>

<?php
    include $templates['footer'];
