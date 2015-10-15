/*!
 XOOPS Spinner Plugin
 Author: Eduardo Cortés (AKA bitcero)
 Copyright: © 2015 The Xoops Project (http://xoops.org)
 License: GPL 2 or later
 */
(function ($) {

    $.fn.xoSpinner = function (options) {

        /**
         * icon can be any XOOPS SVG icon or other
         * type must be spin or pulse
         * spinner can be show or hide
         */
        var settings = $.extend({
            icon: 'xicon-spinner-06',
            type: 'spin',
            hide: 'xo-icon-svg',
            steps: 12, // Only useful when type equal to 'pulse'
            speed: 3    // 1 to 5 - only valid when type equal to spin
        }, options);

        settings.type = settings.type != 'spin' && settings.type != 'pulse' ? 'spin' : settings.type;

        var style = settings.type == 'pulse' ? 'animation: xo-spin 1s infinite steps('+settings.steps+')' : 'animation: xo-spin '+((2/6) * settings.speed)+'s infinite linear;'

        /**
         * Container must have a child with class xo-icon-sv
         * other wise this plugin could cause conflicts
         */
        return this.each(function () {

            var el = $(this);
            var theIcon = xoops.getIcon(settings.icon);

            if (!theIcon) {
                theIcon = xoops.getIcon('xicon-spinner-06');
            }

            /**
             * Verify if spinner is pressent. If yes we need to remove it
             * and show the other icon
             */
            var exists = $(this).find('.xo-spinner');
            if (exists.length > 0) {
                $(exists).remove();
                $(this).find('.xo-spinner-hide').removeClass('xo-spinner-hide').show();
                return true;
            }

            /**
             * Add the spinner
             */
            var spinner = $("<span />", {class: 'xo-icon-svg xo-spinner ' + settings.type, style: style});
            spinner.load(theIcon, function () {
                // Hide the required class
                var toHide = $(el).find('.' + settings.hide);
                if(toHide.length > 0){
                    toHide.addClass('xo-spinner-hide').hide();
                    $(toHide[0]).after(spinner);
                } else {
                    $(el).prepend(spinner);
                }
            });

            return true;

        });

    }

}(jQuery));