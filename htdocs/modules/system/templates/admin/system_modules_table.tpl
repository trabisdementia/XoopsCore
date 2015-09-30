<div class="panel panel-default" id="table-installed-modules">

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>&nbsp;</th>
                <th>Module</th>
                <th class="text-center">Version</th>
                <th class="text-center">Updated</th>
                <th class="text-center">Author(s)</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <{foreach item=module from=$modules_list}>
                <tr<{if !$module->getVar('isactive')}> class="disabled"<{/if}>>
                    <td class="text-center">
                        <a class="xo-module-icon" href="<{$xoops_url}>/modules/<{$module->getVar('dirname')}>/<{$module->getInfo('adminindex')}>">
                            <{if $logo_mode=='icons'}>
                                <{xoicon icon=$module->getInfo('icon')}>
                            <{else}>
                                <img src="../<{$module->getVar('dirname')}>/<{$module->getInfo('image')}>" alt="<{$module->getVar('name')}>">
                            <{/if}>
                        </a>
                    </td>
                    <td>
            <span class="name" title="<{translate key='CLICK_TO_EDIT_MODULE_NAME' dirname='system'}>">
                <strong id="<{$module->getVar('mid')}>" class="rename"><{$module->getVar('name')}></strong>
            </span>
                        <small class="help-block">
                            <{$module->getInfo('description')}>
                        </small>
                    </td>
                    <td class="text-center version">
                        <{$module->getInfo('version')}>
                    </td>
                    <td class="text-center updated">
                        <{$module->getInfo('update')}>
                    </td>
                    <td class="text-center">
                        <{if is_array($module->getInfo('author'))}>
                            <ul class="authors">
                                <{foreach item=author from=$module->getInfo('author')}>
                                    <li>
                                        <a href="<{if $author.url != ''}><{$author.url}><{elseif $author.email != ''}>mailto:<{$author.email}><{else}>#<{/if}>" target="_blank" title="<{$systemLang.author_aka|sprintf:$author.name:$author.aka}>">
                                            <img src="http://www.gravatar.com/avatar/<{if $author.email != ''}><{$author.email|md5}><{else}><{"`$author.aka`@xoops.org"|md5}><{/if}>?s=60&d=<{cycle values="wavatar,identicon,monsterid,retro"}>&r=g">
                                        </a>
                                    </li>
                                <{/foreach}>
                            </ul>
                        <{else}>
                            <span class="author"><{$module->getInfo('author')|replace:",":'<br>'|replace:';':'<br>'}></span>
                        <{/if}>
                    </td>
                    <td class="text-center" nowrap="nowrap">
                        <ul class="xo-item-options">
                            <li>
                                <a href="#" data-action="module-info" class="bg-info" data-mid="<{$module->getVar('mid')}>" title="<{translate key='DETAILS'}>">
                                    <{xoicon icon="xicon-info-circle"}>
                                </a>
                            </li>
                            <li>
                                <a data-action="module-update" class="bg-palegreen" href="#" data-id="<{$module->getVar('mid')}>" title="<{translate
                                key='A_UPDATE'}>">
                                    <{xoicon icon="xicon-refresh"}>
                                </a>
                            </li>
                            <{if $module->getInfo('can_disable')}>
                            <li>
                                    <a id="active-table-<{$module->getVar('mid')}>" class="<{if $module->getVar('isactive')
                                    }>bg-warning<{else}>bg-success<{/if}>" href="#"
                                       onclick="module_Disable(<{$module->getVar('mid')
                                    }>,'','');
                                            return false;" title="<{if $module->getVar('isactive')}><{translate key='A_DISABLE'}><{else}><{translate key='A_ENABLE'}><{/if}>">
                                        <{if $module->getVar('isactive')}>
                                            <{xoicon icon="xicon-pause-circle"}>
                                        <{else}>
                                            <{xoicon icon="xicon-play-circle"}>
                                        <{/if}>
                                    </a>
                            </li>
                            <{/if}>
                            <{if $module->getInfo('can_delete')}>
                            <li>
                                <a class="xo-tooltip bg-danger" href="#" onclick="module_Uninstall(<{$module->getVar('mid')}>); return false;"
                                   title="<{translate key='A_UNINSTALL'}>">
                                    <{xoicon icon="xicon-minus-circle-o"}>
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