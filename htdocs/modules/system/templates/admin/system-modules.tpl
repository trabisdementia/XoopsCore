<{include file="admin:system/admin_tips.tpl"}>
<{include file="admin:system/admin_buttons.tpl"}>

<div class="modules-container">

    <div class="active" id="installed-modules">

        <div id="view-canvas" data-mode="<{$view_mode}>">
            <{if $view_mode=='list'}>
                <{include file="admin:system/system-modules-table.tpl"}>
            <{else}>
                <{include file="admin:system/system-modules-card.tpl"}>
            <{/if}>
        </div>

    </div>

    <div class="fade" id="available-modules">
        <{foreach item=module from=$modules_available}>
            <{$module->getInfo('dirname')}>
        <{/foreach}>
    </div>

    <div class="fade" id="download-modules">
        Download New Modules
    </div>


</div>