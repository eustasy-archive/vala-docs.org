<?php
    // 404 checking of requested package
    require_once __DIR__.'/../_settings/docs.php';

    $requestUri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $pkg = substr($requestUri, 1);

    if (!file_exists($settings["docs"]["directory"]."/".$pkg.".xml")) {
        require __DIR__."/404.php";
        return;
    }
?>

<?php
    require_once __DIR__."/../_templates/sitewide.php";

    $page["sidebar"][] = ['<a href="#"><li class="package">'.$pkg.'</li></a>'];
    $page["sidebar"][] = [
        '<a href="#"><li class="namespace">thing</li></a>',
        '<a href="#"><li class="namespace">thing</li></a>'
    ];

    include $templates["header"];
?>

<section class="content">
    <h1><?php echo $pkg; ?></h1>
    <div class="wrapper">
        <p>ATK provides the set of accessibility interfaces that are implemented by other toolkits and applications. Using the ATK interfaces, accessibility tools have full access to view and control running applications.</p>
    </div>
    <div>
        <h4 sticky>Interfaces</h4>
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
    <div>
        <h4 sticky>Classes</h4>
        <ul class="wrapper" id="class">
            <li>
                <a href="#">AttributeSet</a>
                <span>This is a singly-linked list (a SList) of Attribute.</span>
            </li>
            <li>
                <a href="#">GObjectAccessible</a>
                <span>This object class is derived from AtkObject.</span>
            </li>
            <li>
                <a href="#">Hyperlink</a>
                <span>An ATK object which encapsulates a link or set of links (for instance in the case of client-side image maps) in a hypertext document.</span>
            </li>
            <li>
                <a href="#">Misc</a>
                <span>A set of utility functions for thread locking.</span>
            </li>
            <li>
                <a href="#">NoOpObject</a>
                <span>An AtkNoOpObject is an AtkObject which purports to implement all ATK interfaces.</span>
            </li>
            <li>
                <a href="#">NoOpObjectFactory</a>
                <span>The AtkObjectFactory which creates an AtkNoOpObject.</span>
            </li>
            <li>
                <a href="#">Object</a>
                <span>This class is the primary class for accessibility support via the Accessibility ToolKit (ATK).</span>
            </li>
            <li>
                <a href="#">ObjectFactory</a>
                <span>This class is the base object class for a factory used to create an accessible object for a specific GType.</span>
            </li>
            <li>
                <a href="#">Plug</a>
                <span>See Socket</span>
            </li>
            <li>
                <a href="#">Range</a>
                <span>Range are used on Value, in order to represent the full range of a given component (for example an slider or a range control), or to define each individual subrange this full range is splitted if available.</span>
            </li>
            <li>
                <a href="#">Registry</a>
                <span>The AtkRegistry is normally used to create appropriate ATK "peers" for user interface components.</span>
            </li>
        </div>
    </ul>
</section>

<?php
    include $templates["footer"];
