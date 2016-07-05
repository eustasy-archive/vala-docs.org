<?php

// 404 checking of requested package
require_once __DIR__."/../_functions/database/find.php";

$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$uri_one = substr($requestUri, 1);

$namespaces = database_find("namespaces", [
    "package" => $uri_one
]);

if (!isset($namespaces[0])) {
    require __DIR__."/404.php";
    return;
}

// Process the page
$package = $namespaces[0]["package"];

require_once __DIR__."/../_templates/sitewide.php";

$page["sidebar"][] = [
    '<a href="#"><li class="package">'.$package.'</li></a>'
];

$page["sidebar"][] = array_map(function($namespace) {
    return '<a href="/'.$namespace["package"].'/'.$namespace["id"].'"><li class="namespace">'.$namespace["name"].'</li></a>';
}, $namespaces);

include $templates["header"];

?>

<section class="content">
    <h1><?php echo $package; ?></h1>
    <div>
        <h4 class="sticky">Interfaces</h4>
        <ul class="wrapper" id="interface">
            <li>
                <a href="#">Action</a>
                <span>Action should be implemented by instances of Object classes with which the user can interact directly, i.e. buttons, checkboxes, scrollbars, e.g. components which are not "passive" providers of UI information.</span>
            </li>
            <li>
                <a href="#">Component </a>
                <span>Component should be implemented by most if not all UI elements with an actual on-screen presence, i.e. components which can be said to have a screen-coordinate bounding box.</span>
            </li>
            <li>
                <a href="#">Document</a>
                <span>The AtkDocument interface should be supported by any object whose content is a representation or view of a document.</span>
            </li>
            <li>
                <a href="#">EditableText</a>
                <span>EditableText should be implemented by UI components which contain text which the user can edit, via the Object corresponding to that component (see Object).</span>
            </li>
            <li>
                <a href="#">AtkHyperlinkImpl</a>
                <span>AtkHyperlinkImpl allows AtkObjects to refer to their associated AtkHyperlink instance, if one exists.</span>
            </li>
            <li>
                <a href="#">Hypertext</a>
                <span>An interface used for objects which implement linking between multiple resource or content locations, or multiple 'markers' within a single document.</span>
            </li>
            <li>
                <a href="#">Image</a>
                <span>Image should be implemented by Object subtypes on behalf of components which display image/pixmap information onscreen, and which provide information (other than just widget borders, etc.</span>
            </li>
            <li>
                <a href="#">Implementor</a>
                <span>The AtkImplementor interface is implemented by objects for which AtkObject peers may be obtained via calls to iface->(ref_accessible)(implementor);</span>
            </li>
            <li>
                <a href="#">Selection</a>
                <span>Selection should be implemented by UI components with children which are exposed by atk_object_ref_child and get_n_children, if the use of the parent UI component ordinarily involves selection of one or more of the objects corresponding to those Object children - for example, selectable lists.</span>
            </li>
            <li>
                <a href="#">StreamableContent</a>
                <span>An interface whereby an object allows its backing content to be streamed to clients.</span>
            </li>
            <li>
                <a href="#">Table</a>
                <span>Table should be implemented by components which present elements ordered via rows and columns.</span>
            </li>
            <li>
                <a href="#">TableCell</a>
                <span>Being Table a component which present elements ordered via rows and columns, an TableCell is the interface which each of those elements, so "cells" should implement.</span>
            </li>
            <li>
                <a href="#">Text</a>
                <span>Text should be implemented by Objects on behalf of widgets that have text content which is either attributed or otherwise non-trivial.</span>
            </li>
            <li>
                <a href="#">Value</a>
                <span>Action should be implemented by instances of Object classes with which the user can interact directly, i.e. buttons, checkboxes, scrollbars, e.g. components which are not "passive" providers of UI information.</span>
            </li>
            <li>
                <a href="#">Window</a>
                <span>Window should be implemented by the UI elements that represent a top-level window, such as the main window of an application or dialog.</span>
            </li>
        </ul>
    </div>
</section>

<?php
    include $templates["footer"];
