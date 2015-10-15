/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * Modules Javascript
 *
 * @copyright   XOOPS Project (http://xoops.org)
 * @license     GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author      Andricq Nicolas (AKA MusS)
 * @author      Eduardo Cortes (AKA bitcero) <http://eduardocortes.mx>
 * @version     $Id$
 */

(function($) {

    var helperFunctions = {};

    $(document).ready( function(){

        /**
         * Run actions from buttons
         */
        $("body").on('click', '*[data-action]', function(){
            var id = $(this).data('id');
            var action = $(this).data('action').replace("-",'_');

            if ( typeof helperFunctions[action] == 'function' )
                return helperFunctions[action](id);

            return false;

        });

        /**
         * Switch view mode
         */
        $("input[name='view_mode'],input[name='view_logo']").change(function(){

            var $canvas = $("#view-canvas");

            if($(this).attr("name") == 'view_mode' && $canvas.data('mode') == $(this).data('mode'))
                return false;

            var viewMode = $(this).attr("name") == 'view_mode' ? $(this).data("mode") : $(".header-commands input[name='view_mode']:checked").data("mode");
            var logoMode = $(this).attr("name") == 'view_logo' ? $(this).data("mode") : $(".header-commands input[name='view_logo']:checked").data("mode");

            switch_view($(this), viewMode, logoMode);

        });

        /**
         * Rename modules
         */
        $(".rename").editable("modules.php?op=rename", {
            indicator : "<img src='../../media/xoops/images/spinner.gif'>",
            cssclass : 'span2'
        });

        /*------------------------------------------------
                          MODULE DETAILS
        ------------------------------------------------*/
        $("body").on('click', '[data-action="module-info"]', function(){

            $("body").xoPreload();

            var params = {
                XOOPS_TOKEN_REQUEST: $("#xoops-token").val(),
                op: 'details',
                mid: $(this).data('mid')
            };

            $.get('modules.php', params, function(response){

                if(response.type == 'error'){
                    xoops.modal.alert(response.message);
                    $("body").xoPreload({action: 'hide'});
                    return false;
                }

                xoops.modal.dialog({
                    title: response.title,
                    message: response.content,
                    color: response.installed == 1 ? 'primary' : 'danger',
                    id: 'module-details',
                    buttons: {
                        main: {
                            label: response.close,
                            className: 'btn-primary'
                        }
                    }
                });

                $("body").xoPreload({action: 'hide'});

            },'json');
            return false;
        });

        /*------------------------------------------------
           UPDATE MODULE
         ------------------------------------------------*/
        $("body").on('click', '[data-action="module-update"]', function(){

            if(confirm(xoLang.confirmUpdate)){
                update_module_now($(this).data('id'));
            }

            return false;


        });

        /*------------------------------------------------
           UNINSTALL MODULE
         ------------------------------------------------*/
        $("body").on('click', '[data-action="module-uninstall"]', function(){

            if(!confirm(xoLang.confirmUninstall)){
                return false;
            }

            $("body").xoPreload();

            var params = {
                XOOPS_TOKEN_REQUEST: $("#xo-token").val(),
                op: 'uninstall',
                mid: $(this).data('id')
            };

            $.post('modules.php', params, function(response){

                if(!xoops.AJAX.retrieve(response)){
                    $("body").xoPreload({action: 'hide'});
                    return false;
                }

                $("body").xoPreload({action: 'hide'});

                xoops.modal.dialog({
                    title: response.title,
                    message: response.content,
                    color: 'danger',
                    id: 'module-logger',
                    buttons: {
                        main: {
                            label: response.close != undefined ? response.close : xoLang.close,
                            className: 'btn-primary'
                        }
                    }
                });

                // Remove module from list
                if($("#table-installed-modules")){

                    var $link = $(".xo-item-options a[data-action='module-update'][data-id='"+ response.mid +"']");
                    if($link.length <= 0){
                        return false;
                    }

                    $link.parents("tr").remove();

                } else {

                    $("#mid-" + response.mid).remove();

                }



            },'json');

            return false;


        });

        /*------------------------------------------------
           DISABLE / ENABLE MODULE
         ------------------------------------------------*/
        $("body").on('click', '#installed-modules [data-action="module-active"]', function(){

            if($(this).data('action')=='module-disable'){
                if(!confirm(xoLang.confirmDisable)){
                    return false;
                }
            }

            var id = $(this).data('id');

            if(undefined==id || id <= 0){
                xoops.notify({
                    title: xoLang.error,
                    text: xoLang.noId,
                    addclass: 'alert-danger',
                    icon: 'xicon-alert-triangle',
                    opacity: 1,
                    nonblock: {
                        nonblock: false
                    }
                });

                return false;
            }

            $("body").xoPreload();

            var params = {
                XOOPS_TOKEN_REQUEST: $('#xo-token').val(),
                op: 'active',
                mid: id
            };

            $.post('modules.php', params, function(response){

                if(!xoops.AJAX.retrieve(response)){
                    xoops.modal.alert(response.message);
                    $("body").xoPreload({action: 'hide'});
                    return false;
                }

                $("body").xoPreload({action: 'hide'});

                xoops.notify({
                    title: xoLang.activationResult,
                    text: response.message,
                    addclass: response.active == 1 ? 'alert-success' : 'alert-warning',
                    icon: 'xicon-thumb-up',
                    opacity: 1,
                    nonblock: {
                        nonblock: false
                    }
                });

                // Change button
                var $link = $("li.active-btn > [data-id='"+ response.mid +"']");
                if($link.length <= 0){
                    return false;
                }

                if(response.active == 1){
                    $link.attr('title', xoLang.disable);
                    $link.attr('class', 'bg-warning');
                    xoops.loadIcon('xicon-pause-circle', $link);
                    $link.parents('tr').removeClass('disabled');
                } else {
                    $link.attr('title', xoLang.enable);
                    $link.attr('class', 'bg-success');
                    xoops.loadIcon('xicon-play-circle', $link);
                    $link.parents('tr').addClass('disabled');
                }


            }, 'json');

            return false;

        });

        /*------------------------------------------------
           TOGGLE MODULES LISTS
         ------------------------------------------------*/
        $("body").on('click', 'a[data-toggle="modules"]', function(){

            var target = $(this).attr("href");
            var element = $(this);

            $(element).siblings().removeClass('btn-primary');

            if($(target + '-modules').is(":visible")){
                return false;
            }

            // Get modules list
            var params = {
                XOOPS_TOKEN_REQUEST: $("#xo-token").val(),
                op: target.replace("#", '') + '-modules'
            };

            //$("body").xoPreload();
            $(this).xoSpinner({
                type: 'pulse',
                icon: 'xicon-spinner-07',
                steps: 9
            });

            $.get('modules.php', params, function(response){

                if (!xoops.AJAX.retrieve(response)){
                    $(element).xoSpinner();
                    return false;
                }

                $(target + '-modules').html(response.content);

                //$("body").xoPreload({action: 'hide'});
                $(element).xoSpinner();

                element.addClass('btn-primary');
                $(".modules-container > div").removeClass("active");
                $(target + '-modules').addClass('active');

                if("#installed" == target){
                    $(".rename").editable("modules.php?op=rename", {
                        indicator : "<img src='../../media/xoops/images/spinner.gif'>",
                        cssclass : 'span2'
                    });
                }


            }, 'json');

            return false;
        });

        /*------------------------------------------------
                      MODULE INSTALLATION
         ------------------------------------------------*/
        $("body").on('click', '#available-modules [data-action="module-install"]', function(){

            if(!confirm(xoLang.confirmInstall)){
                return false;
            }

            $("body").xoPreload();

            var params = {
                XOOPS_TOKEN_REQUEST: $("#xo-token").val(),
                op: 'install',
                dirname: $(this).data('dirname')
            };

            $.post('modules.php', params, function(response){

                if(!xoops.AJAX.retrieve(response)){
                    $("body").xoPreload({action: 'hide'});
                    return false;
                }

                $("body").xoPreload({action: 'hide'});

                xoops.modal.dialog({
                    title: response.title,
                    message: response.content,
                    color: 'success',
                    id: 'module-logger',
                    buttons: {
                        main: {
                            label: response.close != undefined ? response.close : xoLang.close,
                            className: 'btn-success'
                        }
                    }
                });

                // Update row with new values
                $("#mid-" + response.dirname).remove();


            },'json');

            return false;

        });

    } );


    function update_module_now(mid){

        $("body").xoPreload();

        var params = {
            XOOPS_TOKEN_REQUEST: $("#xo-token").val(),
            op: 'update',
            mid: mid
        };

        $.post('modules.php', params, function(response){

            if(!xoops.AJAX.retrieve(response)){
                $("body").xoPreload({action: 'hide'});
                return false;
            }

            $("body").xoPreload({action: 'hide'});

            xoops.modal.dialog({
                title: response.title,
                message: response.content,
                color: 'primary',
                id: 'module-logger',
                buttons: {
                    main: {
                        label: response.close != undefined ? response.close : xoLang.close,
                        className: 'btn-primary'
                    }
                }
            });

            // Update row with new values
            if($("#table-installed-modules")){
                var $link = $(".xo-item-options a[data-action='module-update'][data-id='"+ response.mid +"']");
                if($link.length <= 0){
                    return false;
                }

                $link.parents("tr").find('.version').html(response.version);
                $link.parents("tr").find('.updated').html(response.updated);
            }

        },'json');

        return false;

    }

    /*------------------------------------------------
                    REFRESH VIEW MODE
    ------------------------------------------------*/
    function switch_view(el, viewMode, logoMode){

        var params = {
            XOOPS_TOKEN_REQUEST: $("#xo-token").val(),
            op: 'change-view',
            logo_mode: logoMode,
            mode: viewMode,
            tab: $(".xo-moduleadmin-buttons .btn-primary").attr('href').replace('#','')
        };

        //$("#view-canvas").xoPreload({action: 'show'});
        $(el).parent().xoSpinner({
            icon: 'xicon-spinner-01',
            type: 'spin',
            speed: 4
        });

        $.post('modules.php', params, function( response ){

            if (!xoops.AJAX.retrieve(response)){

               xoops.notify({
                    title: response.message.title,
                    text: response.message.text,
                    delay: 7000,
                    type: 'danger',
                    nonblock: {
                        nonblock: true,
                        nonblock_opactity:.2
                    }
                });
                $(el).parent().xoSpinner();
                return false;
            }

            if(response.list == 'available'){
                $("#available-modules").html(response.content);
            } else {
                $("#installed-modules").html(response.content);
            }

            $(el).parent().xoSpinner();

            $("#view-canvas").data('mode', response.mode);

        }, 'json');
    }


    //helperFunctions['update-module'] = update_module_now;

})(jQuery);

function module_Detail(id){
    var position = $("#mid-"+id).position();
    $("#detail-"+id).css({'position':'absolute','box-shadow':'2px 2px 1px #888','top':position.top+'px','left':position.left+'px'});
    $("#detail-"+id).slideDown(600);
}

function module_Disable(id, enable, disable){
    $.post( 'admin.php', { fct: 'modulesadmin', op: 'active', mid: id } ,
    function(reponse, textStatus) {
        if (textStatus=='success') {
            if(reponse){
                $('#active-'+id).html('<span class="icon icon-tick"></span>'+enable);
                $('#active-table-'+id).html('<span class="icon icon-tick">&nbsp;</span>');

            } else {
                $('#active-'+id).html('<span class="icon icon-cross"></span>'+disable);
                $('#active-table-'+id).html('<span class="icon icon-cross">&nbsp;</span>');
            }
        }
    });
}

function module_Hide(id){
    $.post( 'modules.php', { op: 'display_in_menu', mid: id } ,
    function(reponse, textStatus) {
        if (textStatus=='success') {
            if(reponse != 0){
                $('#menu-hide-'+id).html('<span class="cursorpointer icon icon-cross">&nbsp;</span>');
            } else {
                $('#menu-hide-'+id).html('<span class="cursorpointer icon icon-tick">&nbsp;</span>');
            }
        }
    });
}

function module_Install(module){
    $('.modal-backdrop').show();
    $('#install-dir').val(module)
    $('#install .modal-data').html($('#data-'+module+' .module_card').html());
    $('#install').show('slow');
}

function module_Uninstall(id){
    $('.modal-backdrop').show();
    $('#uninstall-id').val(id)
    $('#uninstall .modal-data').html($('#data-'+id+' .module_card').html());
    $('#uninstall').show('slow');
}
