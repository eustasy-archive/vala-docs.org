/**
 * Copyright 2016 eustasy
 * The MIT License (MIT)
 */

/**
 * JS toggle logic
 */
$(function () {
    var activeClass = "active";

    $("[js-toggle]").bind("click", function() {
        if ($(this).attr("js-toggle") == null) return

        var targets = $(this).attr("js-toggle").split(" ");

        for (var i = 0; i < targets.length; i++) {
            $(targets[i]).toggleClass(activeClass);
        }
    });
});

/**
 * Sidebar logic
 */
$(function() {
    var c = "active"
    var t = ".sidebar-menu";
    var s = "nav.sidebar";
    var i = "nav.sidebar div.search input";
    var w = "a, input, textarea, button"; // elements consider off limits if in focus

    var dX = 150; // minimum pixels of horizontal movement
    var dY = 0.6; // ration of vertical:horizontal movement limit

    $(t).bind("click", function(e) {
        e.preventDefault();

        if (!$(s).hasClass(c)) {
            $(s).addClass(c);
            $(i).focus();
        } else {
            $(s).removeClass(c);
            $(i).blur();
        }
    });

    $(document).bind("click", function(e) {
        if (!$(s).hasClass(c)) return;
        if ($(e.target).closest(t).length !== 0) return;

        if ($(e.target).closest(s).length === 0) {
            $(s).removeClass(c);
            $(i).blur();
        }
    });

    $(document).bind("keyup", function(e) {
        var code = e.keyCode || e.which;

        if (code === 27 && $(s).hasClass(c)) { // esc key
            $(s).removeClass(c);
            $(i).blur();
        }

        if (code === 13 && !$(document.activeElement).is(w) && !$(s).hasClass(c)) { // enter key
            e.preventDefault();
            $(s).addClass(c);
            $(i).focus();
        }
    });

    var x = null;
    var y = null;
    var a = null;
    var b = null;

    $(document).bind("touchstart", function(e) {
        x = e.originalEvent.touches[0].pageX;
        y = e.originalEvent.touches[0].pageY;
    });

    $(document).bind("touchmove", function(e) {
        a = e.originalEvent.touches[0].pageX;
        b = e.originalEvent.touches[0].pageY;
    });

    $(document).bind("touchend", function(e) {
        var w = $(window).width();
        var h = $(window).height();

        // swiped more than dX pixels horizontaly and ratio vertical:horizontal is less than dY
        if (x - a > 0 && Math.abs(x - a) > dX && Math.abs(b - y) / Math.abs(a - x) < dY) {
            $(s).removeClass(c);
            $(i).blur();
        } else if (x - a < 0 && Math.abs(x - a) > dX && Math.abs(b - y) / Math.abs(a - x) < dY) {
            $(s).addClass(c);
            $(i).focus();
        }

        x = null;
        y = null;
        a = null;
        b = null;
    });
});

/**
 * Sticky elements
 */
$(function() {
    var sticky = ".sticky";
    var $elements = $(sticky, "main");

    var debounceTimer = null;

    for (var i = 0; i < $elements.length; i++) {
        $($elements[i]).parent().css("position", "relative");
    }

    var calculate = function() {
        debounceTimer = null;

        for (var i = 0; i < $elements.length; i++) {
            var $element = $($elements[i]);
            var $parent = $element.parent();
            var $previous = $element.prev();

            var height = $element.outerHeight();

            if ($previous != null && $previous.hasClass("stickyholder")) {
                var offset = $previous.offset().top;
            } else {
                var offset = $element.offset().top;
            }

            if (offset > 0) {
                if ($previous.hasClass("stickyholder")) {
                    $previous.remove();
                }

                $element.removeClass("sticky--after sticky--stuck").addClass("sticky--before");
            } else if (height > offset + $parent.outerHeight()) {
                $element.removeClass("sticky--before sticky--stuck").addClass("sticky--after");
            } else if (offset < 0) {
                if (!$previous.hasClass("stickyholder")) {
                    $('<div class="stickyholder"></div>').insertBefore($element).outerHeight(height);
                }

                $element.removeClass("sticky--after sticky--before").addClass("sticky--stuck");
            }
        }
    }

    $("main").on("scroll", function() {
        if ($elements.length < 1) return;

        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(calculate, 50);
    })

    $(window).on("resize", function() {
        if ($elements.length < 1) return;

        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(calculate, 50);
    })
});
