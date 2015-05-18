<div class="row">
    <div class="col-sm-7">

        <div class="row">
            <div class="col-sm-7">
                <!-- Installed modules -->
                <div class="xo-panel xo-panel-azure">
                    <div class="panel-heading">
                        <button class="collapse"></button>
                        <ul class="tools">
                            <li>
                                <a href="modules/system/modules.php" title="<{$sysLang.modules_manager}>">
                                    <{xoicon icon="xicon-gear"}>
                                </a>
                            </li>
                        </ul>
                        <h3><{$sysLang.installed_mods}></h3>
                    </div>
                    <div class="table-responsive collapsable" id="installed-modules">
                        <table class="table table-hover">
                            <{foreach item=module from=$installed_modules}>
                                <tr>
                                    <td width="32">
                                        <a href="<{$xoops_url}>/modules/<{$module.dirname}>/<{if $module.admin}><{$module.admin}><{/if}>">
                                            <{xoicon icon=$module.icon}>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<{$xoops_url}>/modules/<{$module.dirname}>/<{if $module.admin}><{$module.admin}><{/if}>">
                                            <strong><{$module.name}></strong>
                                            <small class="help-block">
                                                <{$module.desc}>
                                            </small>
                                        </a>
                                    </td>
                                    <td class="text-right text-warning">
                                        <small>v<{$module.version}></small>
                                    </td>
                                </tr>
                            <{/foreach}>
                        </table>
                    </div>
                </div>
                <!--// Installed modules -->
            </div>

            <div class="col-sm-5">
                <!-- Installed extensions -->
                <div class="xo-panel">
                    <div class="panel-heading">
                        <button class="collapse"></button>
                        <ul class="tools">
                            <li>
                                <a href="modules/system/extensions.php" title="<{$sysLang.extensions_manager}>">
                                    <{xoicon icon="xicon-gear"}>
                                </a>
                            </li>
                        </ul>
                        <h3><{$sysLang.installed_exts}></h3>
                    </div>
                    <div class="table-responsive collapsable" id="installed-modules">
                        <table class="table table-hover">
                            <{foreach item=module from=$installed_extensions}>
                                <tr>
                                    <td>
                                        <a href="<{$xoops_url}>/modules/<{$module.dirname}>/<{if $module.admin}><{$module.admin}><{/if}>">
                                            <{$module.name}>
                                            <small class="help-block">
                                                <{$module.desc}>
                                            </small>
                                        </a>
                                    </td>
                                    <td class="text-right text-warning">
                                        <small>v<{$module.version}></small>
                                    </td>
                                </tr>
                            <{/foreach}>
                        </table>
                    </div>
                </div>
                <!--// Installed extensions -->
            </div>
        </div>

    </div>
    <div class="col-sm-5">
        <!-- Counters -->
        <div id="top-counters">
            <div class="xo-panel">
                <div class="panel-heading">
                    <button class="collapse"></button>
                    <h3>System status</h3>
                </div>
                <div class="panel-body collapsable">
                    <div class="row">
                        <div class="col-xs-6">
                            <{xowidget id="modules" icon="xicon-module" style="icon" layout="split" bgcolor="bg-orange" size="small"}>
                        </div>
                        <div class="col-xs-6">
                            <{xowidget id="extensions" style="icon" layout="split" bgcolor="bg-sky" size="small"}>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <{xowidget id="users" style="icon" size="small" bgcolor="bg-pink"}>
                        </div>
                        <div class="col-xs-6">
                            <{xowidget id="comments" icon="xicon-comments" style="icon" size="small" bgcolor="bg-palegreen"}>
                        </div>
                    </div>
                </div>
                <div class="panel-footer xoops-version">
                    <div class="row">
                        <div class="col-xs-7">
                            <{xoicon icon="xicon-xoops"}>
                            <strong><{$sysLang.xoops_version}></strong>
                        </div>
                        <div class="col-xs-5 text-right">
                            <{xoicon icon="xicon-world"}>
                            <a href="http://www.xoops.org">xoops.org</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--// Counters -->

        <!-- Users list -->
        <div class="xo-panel xo-panel-palegreen recent-users" id="dashboard-users-list">
            <div class="panel-heading">
                <button class="collapse"></button>
                <ul class="tools">
                    <li>
                        <a href="modules/system/users.php" title="<{$sysLang.users_manager}>">
                            <{xoicon icon="xicon-gear"}>
                        </a>
                    </li>
                    <li>
                        <a href="modules/system/users.php?action=new" title="<{$sysLang.add_user}>">
                            <{xoicon icon="xicon-plus"}>
                        </a>
                    </li>
                </ul>
                <h3><{$sysLang.last_users}></h3>
            </div>
            <div class="table-responsive collapsable">
                <table class="table the-list">
                    <{foreach item=user from=$recent_users}>
                        <tr>
                            <td class="text-center" width="46">
                                <img src="<{$user.avatar}>" alt="<{$user.name}>" class="img-circle">
                            </td>
                            <td>
                                <{if $user.name!=''}>
                                    <{$user.name}>
                                <{else}>
                                    <{$user.uname}>
                                <{/if}>
                            </td>
                            <td class="text-center"><{$user.date}></td>
                            <td width="40">
                                <{if $user.active}>
                                    <{xoicon icon="xicon-check" class="text-success" size='24px'}>
                                <{else}>
                                    <{xoicon icon="xicon-times" class="text-danger" size='24px'}>
                                <{/if}>
                            </td>
                        </tr>
                    <{/foreach}>
                </table>
            </div>
        </div>
        <!--// Users list -->
    </div>
</div>
