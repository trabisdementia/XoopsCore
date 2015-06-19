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
        $("input[name='view_mode']").change(function(){

            var $canvas = $("#view-canvas");

            if($canvas.data('mode') == $(this).data('mode'))
                return false;

            switch_view($(this), $(this).data('mode'));

        });

        /**
         * Rename modules
         */
        $(".rename").editable("admin.php?fct=modulesadmin&op=rename", {
            indicator : "<img src='../../media/xoops/images/spinner.gif'>",
            cssclass : 'span2'
        });

        // -----------------------------------------------------------------

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
    function switch_view(el, type){
        if (undefined == type || '' == type)
            type = 'list';

        var params = {
            XOOPS_TOKEN_REQUEST: $("#xo-token").val(),
            op: 'change-view',
            mode: type
        };
        $("#view-canvas").xoPreload({action: 'show'});
        $.post('modules.php', params, function( response ){

            if (response.error){

                new PNotify({
                    title: response.message.title,
                    text: response.message.text,
                    delay: 7000,
                    type: 'danger',
                    nonblock: {
                        nonblock: true,
                        nonblock_opactity:.2
                    }
                });
                return false;
            }

            if ('cards' == response.mode){
                $("#view-canvas > #table-installed-modules").fadeOut(250, function(){
                    $(this).remove();
                    $("#view-canvas").html(response.content);
                    $("#view-canvas").xoPreload({action: 'hide'});
                });
            } else {
                $("#view-canvas > #cards-installed-modules").fadeOut(250, function(){
                    $(this).remove();
                    $("#view-canvas").html(response.content);
                    $("#view-canvas").xoPreload({action: 'hide'});
                });
            }

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
