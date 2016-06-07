<?php
    require_once __DIR__.'/../_templates/sitewide.php';
    require_once __DIR__.'/../_functions/docs/list.php';

    $page["sidebar"][] = array_map(function($pkg) {
        return '<a href="/'.$pkg.'"><li class="package">'.$pkg.'</li></a>';
    }, docs_list("package"));

    include $templates['header'];
?>

<section class="content">
    <h1>Homepage</h1>
</section>

<?php
    include $templates['footer'];
