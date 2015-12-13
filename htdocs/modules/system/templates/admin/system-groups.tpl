<!--groups-->
<{if $groups_count|default:false}>
<{include file="admin:system/admin-buttons.tpl"}>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                <{$systemLang.existingGroups}>
            </h3>
        </div>
        <div class="table-responsive">
            <table id="xo-group-sorter" class="table tablesorter">
                <thead>
                <tr>
                    <th class="text-center"><{translate key='ID'}></th>
                    <th class="text-left"><{translate key='GROUP_NAME' dirname='system'}></th>
                    <th class="text-center" title="<{translate key='NUMBER_OF_USERS_BY_GROUP' dirname='system'}>"><{xoicon icon="xicon-user"}></th>
                    <th class="text-center"><{translate key='ACTION'}></th>
                </tr>
                </thead>
                <tbody>
                <{foreach item=group from=$groups}>
                    <tr class="<{cycle values='odd, even'}> alignmiddle">
                        <td class="text-center"><{$group.groups_id}></td>
                        <td class="txtleft">
                            <a class="xo-tooltip" href="groups.php?op=groups_edit&amp;groups_id=<{$group.groups_id}>" title="<{translate key='EDIT_GROUP' dirname='system'}>">
                                <strong><{$group.name}></strong>
                            </a>
                            <small class="help-block">
                                <{$group.description}>
                            </small>
                        </td>
                        <td class="text-center">
                            <a href="users.php?selgroups=<{$group.groups_id}>"><{$group.nb_users_by_groups}></a>
                        </td>
                        <td class="xo-actions text-center">

                            <ul class="xo-item-options">
                                <li>
                                    <a class="bg-success" href="groups.php?op=groups_edit&amp;groups_id=<{$group.groups_id}>" title="<{translate key='EDIT_GROUP' dirname='system'}>">
                                        <{xoicon icon="xicon-pencil"}>
                                    </a>
                                </li>
                                <{if $group.delete|default:false}>
                                    <li>
                                        <a class="bg-danger" href="groups.php?op=groups_delete&amp;groups_id=<{$group.groups_id}>" title="<{translate key='DELETE_GROUP' dirname='system'}>">
                                            <{xoicon icon="xicon-times-circle"}>
                                        </a>
                                    </li>
                                <{/if}>
                            </ul>



                        </td>
                    </tr>
                <{/foreach}>
                </tbody>
            </table>
        </div>
    </div>

<!-- Display groups navigation -->
<div class="clear spacer"></div>
<{if $nav_menu|default:false}>
<div class="xo-avatar-pagenav floatright"><{$nav_menu}></div><div class="clear spacer"></div>
<{/if}>
<{/if}>
<!-- Display groups form (add,edit) -->
<{$form|default:''}>