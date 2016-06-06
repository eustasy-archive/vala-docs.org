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
    var c = "active"
    var t = ".sidebar-menu";
    var s = "nav.sidebar";
    var i = "nav.sidebar div.search input";

    $(document).ready(function() {
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
        });

        var x = null;
        var y = null;
        var a = null;
        var b = null;

        $(document).bind("touchstart", function(e) {
            if (!$(s).hasClass(c)) return;

            x = e.originalEvent.touches[0].pageX;
            y = e.originalEvent.touches[0].pageY;
        });

        $(document).bind("touchmove", function(e) {
            if (!$(s).hasClass(c)) return;

            a = e.originalEvent.touches[0].pageX;
            b = e.originalEvent.touches[0].pageY;
        });

        $(document).bind("touchend", function(e) {
            if (!$(s).hasClass(c)) return;

            var w = $(window).width();
            var h = $(window).height();

            // swiped left more than 80% of viewport width and less than 60% of height
            if (x - a > w * 0.5 && Math.abs(y - b) < h * 0.6) {
                $(s).removeClass(c);
                $(i).blur();
            }
        })
    });
});
