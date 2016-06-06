/**
 * Copyright 2016 eustasy
 * The MIT License (MIT)
 */

/**
 * JS toggle logic
 */
$(function() {
    var activeClass = 'active';

    $(document).ready(function() {
        $("[js-toggle]").bind("click", function() {
            if ($(this).attr("js-toggle") == null) return

            var targets = $(this).attr("js-toggle").split(" ");

            for (var i = 0; i < targets.length; i++) {
                $(targets[i]).toggleClass(activeClass);
            }
        });
    });
});

/**
 * Sidebar logic
 */
$(function() {
    var $trigger = $("[js-toggle~='.sidebar']");
    var activeClass = 'active';
    var sidebarComponents = $trigger.attr("js-toggle").split(" ");

    $(document).ready(function() {
        $(document).bind("click", function(e) {
            var targeted = ($(e.target).closest($trigger).length !== 0);
            for (var i = 0; i < sidebarComponents.length; i++) {
                if ($(e.target).closest(sidebarComponents[i]).length !== 0) {
                    targeted = true
                }
            }

            if (targeted) return

            for (var i = 0; i < sidebarComponents.length; i++) {
                $(sidebarComponents[i]).removeClass(activeClass);
            }
        });
    });
});
