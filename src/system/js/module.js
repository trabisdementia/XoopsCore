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
        $(".rename").editable("admin.php?fct=modulesadmin&op=rename", {
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

                if(response.error){
                    xoops.modal.alert(response.message);
                    $("body").xoPreload({action: 'hide'});
                    return false;
                }

                xoops.modal.dialog({
                    title: response.title,
                    message: response.content,
                    color: 'primary',
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

    } );

    /*------------------------------------------------
                      UPDATE MODULE
    ------------------------------------------------*/
    function update_module(id){
        alert(id);
    }

    /*------------------------------------------------
                    REFRESH VIEW MODE
    ------------------------------------------------*/
    function switch_view(el, viewMode, logoMode){

        var params = {
            XOOPS_TOKEN_REQUEST: $("#xo-token").val(),
            op: 'change-view',
            logo_mode: logoMode,
            mode: viewMode
        };
        $("#view-canvas").xoPreload({action: 'show'});
        $.post('modules.php', params, function( response ){

            if (response.error){

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
                $("#view-canvas").xoPreload({action: 'hide'});
                return false;
            }

            $("#view-canvas > #table-installed-modules,#view-canvas > #cards-installed-modules").fadeOut(250, function(){
                $(this).remove();
                $("#view-canvas").html(response.content);
                $("#view-canvas").xoPreload({action: 'hide'});
            });

            $("#view-canvas").data('mode', response.mode);

        }, 'json');
    }


    helperFunctions['update_module'] = update_module;

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

function module_Update(id){
    $('.modal-backdrop').show();
    $('#update-id').val(id)
    $('#update .modal-data').html($('#data-'+id+' .module_card').html());
    $('#update').show('slow');
}

function module_Uninstall(id){
    $('.modal-backdrop').show();
    $('#uninstall-id').val(id)
    $('#uninstall .modal-data').html($('#data-'+id+' .module_card').html());
    $('#uninstall').show('slow');
}
