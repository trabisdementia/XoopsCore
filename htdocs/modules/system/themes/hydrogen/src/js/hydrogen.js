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

    } );

})(jQuery);
