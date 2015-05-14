<{include file="admin:system/admin_tips.tpl"}>
<{include file="admin:system/admin_buttons.tpl"}>
<script type="text/javascript">
    IMG_ON = '<{xoAdminIcons 'success.png'}>';
    IMG_OFF = '<{xoAdminIcons 'cancel.png'}>';
</script>

<div class="row">
    <div class="col-md-4">
        <{xowidget id="modules" style="icon" layout="solid" bgcolor="bg-yellow" size="small"}>
        <{xowidget id="extensions" style="icon" layout="solid" bgcolor="bg-palegreen"}>
        <{xowidget id="users" style="icon" layout="solid" bgcolor="bg-azure" size="large"}>
        <{xowidget id="comments" style="icon" layout="solid" bgcolor="bg-pink" size="xlarge"}>
    </div>
</div>

<!-- Counters -->
<div class="row" id="top-counters">
    <div class="col-xs-6 col-md-3">
        <{xowidget id="modules" style="icon" layout="split" bgcolor="bg-orange" size="small" orientation="vertical"}>
    </div>
    <div class="col-xs-6 col-md-3">
        <{xowidget id="extensions" style="icon" layout="split" bgcolor="bg-primary" orientation="vertical"}>
    </div>
    <div class="col-xs-6 col-md-3">
        <{xowidget id="users" style="icon" layout="split" bgcolor="bg-success" size="large" orientation="vertical"}>
    </div>
    <div class="col-xs-6 col-md-3">
        <{xowidget id="comments" style="icon" layout="split" bgcolor="bg-danger" size="xlarge" orientation="vertical"}>
    </div>
</div>
<!--// Counters -->

<table class="outer">
    <thead>
        <tr>
            <th class="txtcenter"><{translate key='SECTION'}></th>
            <th class="txtcenter"><{translate key='DESCRIPTION'}></th>
            <th class="txtcenter">&nbsp;</th>
            <th class="txtcenter">&nbsp;</th>
        </tr>
    </thead>

    <tbody>
    <{foreach item=menuitem from=$menu}>
    <tr class="<{cycle values='even,odd'}>">
        <td class="bold width15">
            <a class="xo-tooltip" href="admin.php?fct=<{$menuitem.file}>" title="<{translate key='GO_TO'}>: <{$menuitem.title}>">
                <img class="xo-imgmini" src='<{$theme_icons}>/<{$menuitem.icon}>' alt="<{$menuitem.title}>" />
                <{$menuitem.title}>
            </a>
        </td>
        <td class=""><{$menuitem.desc}></td>
        <td class="width15"><{$menuitem.infos}></td>
        <td class="xo-actions width2">
            <{if $menuitem.used}>
                <img id="loading_<{$menuitem.file}>" src="images/spinner.gif" style="display:none;" alt="<{translate key='LOADING'}>" />
                <img class="xo-tooltip" id="<{$menuitem.file}>" onclick="system_setStatus( { op: 'system_activate', type: '<{$menuitem.file}>' }, '<{$menuitem.file}>', 'admin.php' )" src="<{if $menuitem.status}><{xoAdminIcons 'success.png'}><{else}><{xoAdminIcons 'cancel.png'}><{/if}>" alt="<{translate key='CHANGE_STATUS'}>" title="<{translate key='CHANGE_STATUS'}>" />
            <{/if}>
        </td>
    </tr>
    <{/foreach}>
    </tbody>
</table>