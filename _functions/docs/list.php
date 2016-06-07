<?php

require_once __DIR__.'/../../_settings/docs.php';

/**
 * _remove_xml
 * Removes '.xml' from array of strings
 *
 * @param {Array} arr - array of strings to replace
 * @return {Array} array of replaced strings
 */
function _remove_xml ($arr) {
    return array_map(function($s) {
        return str_replace('.xml', '', $s);
    }, $arr);
}

/**
 * docs_list
 * Lists items from filter
 *
 * @param {String} type - what type to list (package, method, etc)
 * @param {Array} filter - tree to filter by
 * @return {Array}
 * @example docs_list ("const", ["clutter-1.0", "Clutter", "Key"])
 */
function docs_list ($type = "package", $filter = []) {
    global $settings;

    $folder = _remove_xml(scandir($settings['docs']['directory']));
    $packages = array_diff($folder, ["..", "."], $settings["docs"]["blacklist"]);

    if ($type === "package") {
        return $packages;
    }

    return [];
}
