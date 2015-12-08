<{if $users_display|default:false}>
    <{include file="admin:system/admin_buttons.tpl"}>
<!--Display form sort-->
    <form action="users.php" method="post">
    <div class="row">
        <div class="col-sm-2">
            <input type="text" name="user_uname" value="<{$user_uname}>" class="form-control" placeholder="<{$systemLang.searchUser}>">
        </div>
        <div class="col-sm-2">
            <select name="selgroups" class="form-control">
                <option value="" selected="selected"><{$systemLang.allGroups}></option>';
                <{foreach item=group from=$group_arr}>
                    <option value="<{$group->getVar("groupid")}>"<{if $selgroups == $group->getVar("groupid")}> selected="selected"<{/if}>><{$group->getVar("name")}></option>
                <{/foreach}>
            </select>
        </div>
        <div class="col-sm-2">
            <select name="user_type" class="form-control">
                <option value=""<{if $user_type == ''}> selected="selected"<{/if}>><{$systemLang.allUsers}></option>
                <option value="actv"<{if $user_type === 'actv'}> selected="selected"<{/if}>><{$systemLang.activeUsers}></option>
                <option value="inactv"<{if $user_type === 'inactv'}> selected="selected"<{/if}>><{$systemLang.inactiveUsers}></option>
            </select>
        </div>
        <div class="col-sm-2 col-md-1">
            <select name="user_limit" class="form-control">
                <option value="20"<{if $user_limit == 20}>selected="selected"<{/if}>>20</option>
                <option value="50"<{if $user_limit == 50}> selected="selected"<{/if}>>50</option>
                <option value="100"<{if $user_limit == 100}> selected="selected"<{/if}>>100</option>
            </select>
        </div>
        <div class="col-sm-4">
            <input type="hidden" name="user_uname_match" value="XOOPS_MATCH_START" />
            <button class="btn btn-primary" type="submit" title="<{$systemLang.search}>"><{xoicon icon="xicon-search"}></button>
            <input class="btn btn-success" type="submit" value="<{$systemLang.advancedSearch}>" name="complet_search">
        </div>
    </div>
    </form>

    <hr>

    <form name='memberslist' id='memberslist' action='<{$php_selft}>' method='POST'>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Table Title</h3>
            </div>
            <div class="table-responsive">
                <table id="xo-users-sorter" class="table">
                    <thead>
                    <tr>
                        <th class="text-center">
                            <input name='allbox' id='allbox' onclick='xoopsCheckAll("memberslist", "allbox");'  type='checkbox' value='Check All' />
                        </th>
                        <th class="text-center"><{translate key='STATUS'}></th>
                        <th class="text-left"><{translate key='USER_NAME'}></th>
                        <th class="text-center"><{xoicon icon="xicon-envelope"}></th>
                        <th class="text-center"><{translate key='REGISTRATION_DATE'}></th>
                        <th class="text-center"><{translate key='LAST_LOGIN'}></th>
                        <th class="text-center"><{xoicon icon="xicon-send"}></th>
                        <th class="text-center width10"><{translate key='ACTION'}></th>
                    </tr>
                    </thead>
                    <!--Display data-->
                    <{if $users_count == true}>
                        <tbody>
                        <{foreach item=user from=$users}>
                            <tr class="<{cycle values='even,odd'}> alignmiddle">
                                <td class="text-center">
                                    <{if $user.checkbox_user}><input type='checkbox' name='memberslist_id[]' id='memberslist_id[]' value='<{$user.uid}>' /><{/if}>
                                </td>
                                <td class="text-center">
                                    <{if $user.group=='admin'}>
                                        <{xoicon icon="xicon-user" class="text-danger"}>
                                    <{else}>
                                        <{xoicon icon="xicon-user" class="text-info"}>
                                    <{/if}>
                                </td>
                                <td>
                                    <strong><a title="<{$user.uname}>" href="<{$xoops_url}>/userinfo.php?uid=<{$user.uid}>" ><{$user.uname}></a></strong>
                                    <{if $user.name}>
                                        <br><small><{$user.name}></small>
                                    <{/if}>
                                </td>
                                <td class="text-center">
                                    <code><{$user.email}></code>
                                </td>
                                <td class="text-center">
                                    <small><{$user.reg_date}></small>
                                </td>
                                <td class="text-center">
                                    <small><{$user.last_login}></small>
                                </td>
                                <td class="text-center"><div id="display_post_<{$user.uid}>"><{$user.posts}></div><div id='loading_<{$user.uid}>' class="text-center" style="display:none;"><img src="./images/mimetypes/spinner.gif" title="Loading" alt="Loading"/></div></td>
                                <td class="xo-actions text-center">
                                    <ul class="xo-item-options">
                                    <{if $user.user_level > 0}>
                                        <li>
                                            <a href="#" class="bg-warning" onclick="display_post('<{$user.uid}>');" title="<{translate key='A_SYNCHRONIZE'}>">
                                                <{xoicon icon="xicon-refresh"}>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="bg-info" onclick="display_dialog('<{$user.uid}>', true, true, 'slide', 'slide', 300, 400); return false;" title="<{translate key='VIEW_USER_INFO' dirname='system'}>">
                                                <{xoicon icon="xicon-info-circle"}>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="bg-success" href="users.php?op=users_edit&amp;uid=<{$user.uid}>" title="<{translate key='EDIT_USER' dirname='system'}>">
                                                <{xoicon icon="xicon-pencil"}>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="bg-danger" href="users.php?op=users_delete&amp;uid=<{$user.uid}>" title="<{translate key='DELETE_USER' dirname='system'}>">
                                                <{xoicon icon="xicon-times-circle"}>
                                            </a>
                                        </li>
                                    <{else}>
                                        <li>
                                            <a class="bg-success" href="users.php?op=users_active&amp;uid=<{$user.uid}>" title="<{translate key='ONLY_ACTIVE_USERS' dirname='system'}>">
                                                <{xoicon icon="xicon-check-bold"}>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="bg-info" onclick="display_dialog('<{$user.uid}>', true, true, 'slide', 'slide', 300, 400); return false;" title="<{translate key='VIEW_USER_INFO' dirname='system'}>">
                                                <{xoicon icon="xicon-info-circle"}>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="bg-success" href="users.php?op=users_edit&amp;uid=<{$user.uid}>" title="<{translate key='EDIT_USER' dirname='system'}>">
                                                <{xoicon icon="xicon-pencil"}>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="bg-danger" href="users.php?op=users_delete&amp;uid=<{$user.uid}>" title="<{translate key='DELETE_USER' dirname='system'}>">
                                                <{xoicon icon="xicon-times-circle"}>
                                            </a>
                                        </li>
                                    <{/if}>
                                    </ul>
                                </td>
                            </tr>
                        <{/foreach}>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td class='txtleft' colspan='8'>
                                <select name='fct' onChange='changeDisplay (this.value, "groups", "edit_group")' class="form-control" style="max-width: 150px; display: inline-block">
                                    <option value=''>---------</option>
                                    <option value='mailusers'><{translate key='SEND_EMAIL'}></option>
                                    <option value='groups'><{translate key='EDIT_GROUPS' dirname='system'}></option>
                                    <option value='users'><{translate key='A_DELETE'}></option>
                                </select>&nbsp;
                                <select name='edit_group' id='edit_group' onChange='changeDisplay (this.value, this.value, "selgroups")' style="display:none; max-width: 150px;" class="form-control">
                                    <option value=''>---------</option>
                                    <option value='add_group'><{translate key='ADD_GROUP' dirname='system'}></option>
                                    <option value='delete_group'><{translate key='DELETE_GROUP' dirname='system'}></option>
                                </select>
                                <{$form_select_groups}>
                                <input type="hidden" name="op" value="action_group">
                                <button class="btn btn-danger" type='submit'><{$systemLang.submit}></button>
                            </td>
                        </tr>
                        </tfoot>
                    <{/if}>
                    <!--No found-->
                    <{if $users_no_found|default:false}>
                        <tr class="<{cycle values='even,odd'}> alignmiddle">
                            <td colspan='8' class="text-center"><{translate key='E_USERS_NOT_FOUND'}></td>
                        </tr>
                    <{/if}>
                </table>
            </div>
        </div>
    </form>
    <!--Pop-pup-->
    <{if $users_count == true}>
        <{foreach item=users from=$users_popup}>
            <div id="dialog<{$users.uid}>" title="<{$users.uname}>" style='display:none;'>
                <table>
                    <tr>
                        <td class="text-center">
                            <img src="<{$users.user_avatar}>" alt="<{$users.uname}>" title="<{$users.uname}>" />
                        </td>
                        <td class="text-center">
                            <a href='mailto:<{$users.email}>'><img src="<{xoAdminIcons 'mail_send.png'}>" alt="" title="<{translate key='EMAIL'}>" /></a>
                            <a href='javascript:openWithSelfMain("<{$xoops_url}>/pmlite.php?send2=1&amp;to_userid=<{$users.uid}>","pmlite",450,370);'><img src="<{xoAdminIcons 'pm.png'}>" alt="" title="<{translate key='PM'}>" /></a>
                            <a href='<{$users.url}>' rel='external'><img src="<{xoAdminIcons 'url.png'}>" alt="" title="<{translate key='WEB_URL'}>" ></a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <ul style="border: 1px solid #666; padding: 8px;">
                                <{if $users.user_name|default:false}><li><span class="bold"><{translate key='NAME'}></span>&nbsp;:&nbsp;<{$users.name}></li><{/if}>
                                <li><span class="bold"><{translate key='USER_NAME'}></span>&nbsp;:&nbsp;<{$users.uname}></li>
                                <li><span class="bold"><{translate key='EMAIL'}></span>&nbsp;:&nbsp;<{$users.email}></li>
                                <{if $users.user_url|default:false}><li><span class="bold"><{translate key='WEB_URL'}></span>&nbsp;:&nbsp;<{$users.url}> </li><{/if}>
                                <{if $users.user_icq|default:false}><li><span class="bold"><{translate key='ICQ'}></span>&nbsp;:&nbsp;<{$users.user_icq}></li><{/if}>
                                <{if $users.user_aim|default:false}><li><span class="bold"><{translate key='AIM'}></span>&nbsp;:&nbsp;<{$users.user_aim}></li><{/if}>
                                <{if $users.user_yim|default:false}><li><span class="bold"><{translate key='YIM'}></span>&nbsp;:&nbsp;<{$users.user_yim}></li><{/if}>
                                <{if $users.user_msnm|default:false}><li><span class="bold"><{translate key='MSNM'}></span>&nbsp;:&nbsp;<{$users.user_msnm}> </li><{/if}>
                            </ul>
                        </td>
                    </tr>
                </table>
            </div>
        <{/foreach}>
    <{/if}>
    <!--Pop-pup-->
    <div class='txtright'><{$nav|default:''}></div>
<{/if}>
<br />
<!-- Display Avatar form (add,edit) -->
<{$form|default:''}>