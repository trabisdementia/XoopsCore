/*!
Xoops Preload Plugin
Shows a preload animation
 */
(function($){

    $.fn.xoPreload = function(options){

        var settings = $.extend({
            action: 'show',
            position: 'absolute'
        }, options);

        return this.each(function(){

            if( settings.action == 'hide' ){
                $(this).find(".xo-preload-animation").remove();
                $(this).find(".xo-preload-overlay").remove();
                return true;
            }

            if($(this).find(".xo-preload-overlay").length > 0){
                $(this).find(".xo-preload-overlay").css('position', settings.position);
                $(this).find(".xo-preload-animation").css('position', settings.position);
                $(this).find(".xo-preload-overlay").fadeIn(250);
                $(this).find(".xo-preload-animation").fadeIn(250);
                return true;
            }

            var html = '<div class="xo-preload-overlay" style="position: '+settings.position+';"></div><div class="xo-preload-animation" style="position: '+settings.position+';"><span id="xo-preload-animation_1"></span><span id="xo-preload-animation_2"></span><span id="xo-preload-animation_3"></span></div>';
            var currentPos = $(this).css('position');
            if ( currentPos != 'absolute' && currentPos != 'relative' && currentPos != 'fixed' )
                $(this).css('position', 'relative');
            $(this).append(html);
            $(this).find(".xo-preload-overlay").fadeIn(250, function(){
                $(this).siblings('.xo-preload-animation').fadeIn(250);
            })

        });

    }

}(jQuery));