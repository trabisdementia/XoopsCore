//@prepros-prepend perfect-scrollbar.jquery.js
//@prepros-prepend xopreload.jquery.js

/*!
 * Hydrogen Theme for XOOPS 2.6 v1
 * Copyright 2015 The XOOPS project http://sf.net/projects/xoops/
 * GNU GPL 2 (http://www.gnu.org/licenses/gpl-2.0.html)
 * Author: Eduardo Cortés (AKA bitcero) <i.bitcero@gmail.com>
 */
(function($){
    $(document).ready( function(){

        // Sets the height of sidebar
        $("#hydrogen-sidebar").perfectScrollbar();

        if ($("#installed-modules").length > 0){
            $("#installed-modules, #installed-extensions").perfectScrollbar({
                useBothWheelAxes: false,
                suppressScrollX: true
            });
        }

        if ($("#dashboard-users-list").length > 0){
            $("#dashboard-users-list .table-responsive").perfectScrollbar();
        }

        if ($("#xo-toolbar .alert-button").length > 0){
            $("#xo-toolbar .alert-button .messages-container").perfectScrollbar({
                suppressScrollX: true
            });
        }

        if ($(".xo-toolbar").length > 0){
            $(".xo-toolbar").perfectScrollbar({
                useBothWheelAxes: true,
                suppressScrollY: true
            });
        }

        /**
         * Menu accordion
         */
        $(".hydrogen-sidebar ul > li.menu > a:first-child").click(function(){

            // Collapse visible menus
            if ($(this).siblings(".nav-menu").is(":visible")){
                $(this).siblings(".nav-menu").slideUp(250);
                $(this).parent().removeClass('open');
                return false;
            }

            $(".hydrogen-sidebar ul .nav-menu:visible").each(function(index){
                $(this).slideUp(250);
                $(this).parent().removeClass('open');
            });
            $(this).siblings(".nav-menu").slideToggle(250);
            $(this).parent().addClass('open');
            return false;
        });

        /**
         * Menu bar toggler
         */
        $("#xo-toolbar .menu-toggler > .menu-toggle").click(function(){
            $("body").toggleClass('collapsed-sidebar');
            if ($("body").hasClass('collapsed-sidebar')){
                Cookies.set('hydrogensb', 1, {expires: 30, path: '/'});
            } else {
                Cookies.remove('hydrogensb', {path: '/'});
            }
        });

        $(".hydrogen-sidebar .nav-separator a").click(function(){
            var siblings = $(this).data("siblings");
            if ('' == siblings)
                return false;

            $(".hydrogen-sidebar li." + siblings).fadeToggle(250);
            return false;
        });

        /* Xoops Panels */
        $("body").on('click', ".xo-panel > .panel-heading > .collapse", function(){
            $(this).toggleClass("collapsed");
            $(this).parent().siblings(".collapsable").slideToggle(250);
        });

        /* Options toggle */
        $("body").on('click', '.btn-options-toggle', function(){
            var $parent = $(this).parents("tr");
            var $options = $parent.next(".xo-options-row").find(".xo-item-options");

            if($options.length <= 0)
                return;

            if(!$options.is(":visible")){
                $(".xo-item-options:visible").slideUp(250);
                $(".active-options").removeClass('active-options');
                $parent.parents("table").addClass('options-activated');
                $parent.toggleClass('active-options');
                $options.slideToggle(250);
            } else {
                $options.slideToggle(250, function(){
                    $parent.parents("table").removeClass('options-activated');
                    $parent.siblings("tr").removeClass('inactive');
                    $parent.toggleClass('active-options');
                });
            }

        });

    } );

})(jQuery);
