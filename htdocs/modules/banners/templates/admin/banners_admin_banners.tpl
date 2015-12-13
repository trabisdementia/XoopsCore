<{include file="admin:system/admin_tips.tpl"}>
<{include file="admin:system/admin-buttons.tpl"}>
<{$info_msg|default:''}>
<{$error_msg|default:''}>
<!--Banner-->
<{if $banner_count|default:false}>
<h4><{$smarty.const._AM_BANNERS_BANNERS_CURRENT}></h4>

    <div class="table-responsive">
        <table id="xo-bannerslist-sorter" class="table">
            <thead>
            <tr>
                <th class="text-center" width="60"><{$smarty.const._AM_BANNERS_BANNERS_IMPRESSIONS}></th>
                <th class="text-center"><{$smarty.const._AM_BANNERS_BANNERS_IMPRESIONLEFT}></th>
                <th class="text-center"><{$smarty.const._AM_BANNERS_BANNERS_CLICKS}></th>
                <th class="text-center"><{$smarty.const._AM_BANNERS_BANNERS_NCLICKS}></th>
                <th class="text-center"><{$smarty.const._AM_BANNERS_CLIENTS_NAME}></th>
                <th width="30">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <{foreach item=banneritem from=$banner}>
                <tr>
                    <td class="text-center"><{$banneritem.impmade}></td>
                    <td class="text-center"><{$banneritem.left}></td>
                    <td class="text-center"><{$banneritem.clicks}></td>
                    <td class="text-center"><{$banneritem.percent}>%</td>
                    <td class="text-center"><{$banneritem.name}></td>
                    <td class="text-center" nowrap="nowrap">
                        <ul class="xo-item-options">
                            <li>
                                <a href="#" class="bg-info" title="<{$smarty.const._AM_BANNERS_VIEW}>" onclick="display_dialog(<{$banneritem.bid}>, true, true, 'slide', 'slide', 200, 520);">
                                    <{xoicon icon="xicon-search"}>
                                </a>
                            </li>
                            <li>
                                <a href="banners.php?op=edit&amp;bid=<{$banneritem.bid}>" class="bg-warning" title="<{$smarty.const._AM_BANNERS_EDIT}>">
                                    <{xoicon icon="xicon-pencil"}>
                                </a>
                            </li>
                            <li>
                                <a href="banners.php?op=delete&amp;bid=<{$banneritem.bid}>" class="bg-danger" title="<{$smarty.const._AM_BANNERS_DELETE}>">
                                    <{xoicon icon="xicon-times"}>
                                </a>
                            </li>
                        </ul>
                    </td>
                </tr>
            <{/foreach}>
            </tbody>
        </table>
    </div>

<div class="clear spacer"></div>
<{if $nav_menu_banner|default:false}>
<div class="xo-avatar-pagenav floatright"><{$nav_menu_banner}></div><div class="clear spacer"></div>
<{/if}>
<!--Pop-pup-->
<{foreach item=banner from=$popup_banner}>
<div id="dialog<{$banner.bid}>" title="<{$banner.name}>" style='display:none;'>
    <{$banner.imageurl}>
</div>
<{/foreach}>
<!--Pop-pup-->
<{/if}>

<!--Banner Finish-->
<{if $banner_finish_count|default:false}>
<h4><{$smarty.const._AM_BANNERS_BANNERS_FINISH}></h4>

    <div class="table-responsive">
        <table id="xo-bannersfinish-sorter" class="table">
            <thead>
            <tr>
                <th class="text-center"><{$smarty.const._AM_BANNERS_BANNERS_IMPRESSIONS}></th>
                <th class="text-center"><{$smarty.const._AM_BANNERS_BANNERS_STARTDATE}></th>
                <th class="text-center"><{$smarty.const._AM_BANNERS_BANNERS_ENDDATE}></th>
                <th class="text-center"><{$smarty.const._AM_BANNERS_BANNERS_CLICKS}></th>
                <th class="text-center"><{$smarty.const._AM_BANNERS_BANNERS_NCLICKS}></th>
                <th class="text-center"><{$smarty.const._AM_BANNERS_CLIENTS_NAME}></th>
                <th class="text-center"><{$smarty.const._AM_BANNERS_ACTION}></th>
            </tr>
            </thead>
            <tbody>
            <{foreach item=finished_banner from=$banner_finish}>
                <tr>
                    <td class="text-center"><{$finished_banner.impressions}></td>
                    <td class="text-center"><{$finished_banner.datestart}></td>
                    <td class="text-center"><{$finished_banner.dateend}></td>
                    <td class="text-center"><{$finished_banner.clicks}></td>
                    <td class="text-center"><{$finished_banner.percent}>%</td>
                    <td class="text-center"><{$finished_banner.name}></td>
                    <td class="xo-actions text-center">
                        <img onclick="display_dialog(<{$finished_banner.bid}>, true, true, 'slide', 'slide', 200, 520);" src="<{xoAdminIcons 'display.png'}>" alt="<{$smarty.const._AM_BANNERS_VIEW}>" title="<{$smarty.const._AM_BANNERS_VIEW}>" />
                        <a href="banners.php?op=reload&amp;bid=<{$finished_banner.bid}>" title="<{$smarty.const._AM_BANNERS_BANNERS_RELOAD}>">
                            <img src="<{xoAdminIcons 'reload.png'}>" alt="<{$smarty.const._AM_BANNERS_BANNERS_RELOAD}>"/>
                        </a>
                        <a href="banners.php?op=delete&amp;bid=<{$finished_banner.bid}>" title="<{$smarty.const._AM_BANNERS_DELETE}>">
                            <img src="<{xoAdminIcons 'delete.png'}>" alt="<{$smarty.const._AM_BANNERS_DELETE}>" />
                        </a>
                    </td>
                </tr>
            <{/foreach}>
            </tbody>
        </table>
    </div>

<div class="clear spacer"></div>
<{if $nav_menu_bannerF|default:false}>
<{$nav_menu_bannerF}>
<div class="clear spacer"></div>
<{/if}>
<!--Pop-pup-->
<{foreach item=banner_finish from=$popup_banner_finish}>
<div id="dialog<{$banner_finish.bid}>" title="<{$banner_finish.name}>" style='display:none;'>
    <{$banner_finish.imageurl}>
</div>
<{/foreach}>
<!--Pop-pup-->
<{/if}>
<!-- Display form (add,edit) -->
<{$form|default:''}>