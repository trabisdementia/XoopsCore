<{include file="admin:system/admin_tips.tpl"}>
<{include file="admin:system/admin_buttons.tpl"}>

<div class="modules-container">

    <div class="active" id="installed">

        <div id="view-canvas" data-mode="list">
            <{include file="admin:system/system_modules_table.tpl"}>
        </div>

    </div>
    <div id="available">
        Available Modules
    </div>
    <div id="download">
        Download New Modules
    </div>


</div>

<div id="update" class="modal hide">
    <div class="modal-header">
        <a class="close" href="#" onclick="$('.modal-backdrop').click();">x</a>
        <h3><span class="ico-arrow-refresh-small"></span>&nbsp;<{translate key='A_UPDATE'}></h3>
    </div>
    <div class="modal-body">
        <p class="modal-data"></p>
    </div>
    <div class="modal-footer">
        <form id="update-form" method="post" action="admin.php">
            <a class="btn" href="javascript:" onclick="$('.modal-backdrop').click();">
                <span class="ico-cross"></span>
                <{translate key='A_CANCEL'}>
            </a>
            <a class="btn btn-primary" href="javascript:;" onclick="$('#update-form').submit()">
                <span class="ico-arrow-refresh-small"></span>
                <{translate key='A_UPDATE'}>
            </a>
            <{securityToken}>
            <input type="hidden" name="fct" value="modulesadmin" />
            <input type="hidden" name="op" value="update" />
            <input id="update-id" type="hidden" name="mid" value="" />
        </form>
    </div>
</div>

<div id="uninstall" class="modal hide">
    <div class="modal-header">
        <a class="close" href="#" onclick="$('.modal-backdrop').click();">x</a>
        <h3><span class="ico-application-delete"></span>&nbsp;<{translate key='A_UNINSTALL'}></h3>
    </div>
    <div class="modal-body">
        <p class="modal-data"></p>
    </div>
    <div class="modal-footer">
        <form id="delete-form" method="post" action="admin.php">
            <a class="btn" href="javascript:" onclick="$('.modal-backdrop').click();">
                <span class="ico-cross"></span>
                <{translate key='A_CANCEL'}>
            </a>
            <a class="btn btn-danger" href="javascript:;" onclick="$('#delete-form').submit()">
                <span class="ico-application-delete"></span>
                <{translate key='A_UNINSTALL'}>
            </a>
            <{securityToken}>
            <input type="hidden" name="fct" value="modulesadmin" />
            <input type="hidden" name="op" value="uninstall" />
            <input id="uninstall-id" type="hidden" name="mid" value="" />
        </form>
    </div>
</div>