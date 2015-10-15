<div class="panel panel-midnight" id="table-available-modules">

    <div class="panel-heading">
        <h3 class="panel-title">
            <{xoicon icon="xicon-check"}>
            <{$systemLang.availableModules|strtoupper}>
        </h3>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>&nbsp;</th>
                <th><{$systemLang.module}></th>
                <th class="text-center"><{$systemLang.version}></th>
                <th class="text-center"><{$systemLang.author}></th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <{if !$modules_list}>
                <tr>
                    <td class="text-center text-info" colspan="5">
                        <{$systemLang.noAvailable}>
                    </td>
                </tr>
            <{/if}>
            <{foreach item=module from=$modules_list}>
                <tr id="mid-<{$module->getInfo('dirname')}>">
                    <td class="text-center">
                        <{if $logo_mode=='icons'}>
                            <{xoicon icon=$module->getInfo('icon')}>
                        <{else}>
                            <img src="../<{$module->getInfo('dirname')}>/<{$module->getInfo('image')}>" alt="<{$module->getInfo('name')}>">
                        <{/if}>
                    </td>
                    <td>
                        <span class="name" title="<{translate key='CLICK_TO_EDIT_MODULE_NAME' dirname='system'}>">
                            <strong><{$module->getInfo('name')}></strong>
                        </span>
                        <small class="help-block">
                            <{$module->getInfo('description')}>
                        </small>
                    </td>
                    <td class="text-center version">
                        <{$module->getInfo('version')}>
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
                                <a href="#" data-action="module-info" class="bg-info" data-mid="<{$module->getInfo('dirname')}>" title="<{translate key='DETAILS'}>">
                                    <{xoicon icon="xicon-info-circle"}>
                                </a>
                            </li>
                            <li>
                                <a data-action="module-install" class="bg-success" href="#" data-dirname="<{$module->getInfo('dirname')}>" title="<{$systemLang.install}>">
                                    <{xoicon icon="xicon-check-bold-o"}>
                                </a>
                            </li>
                            <{if $module->getInfo('website')}>
                            <li>
                                <a class="bg-orange" href="<{$module->modinfo['website']['url']}>" target="_blank" title="<{$module->modinfo['website']['name']}>">
                                    <{xoicon icon="xicon-link"}>
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