<{if $module}>
    <{* Log tabs *}>
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#logger-module" aria-controls="general" role="tab" data-toggle="tab">
                <{xoicon icon="xicon-info-circle"}>
                <{$systemLang.module}>
            </a>
        </li>
        <li role="presentation">
            <a href="#logger-log" aria-controls="blocks" role="tab" data-toggle="tab">
                <{xoicon icon="xicon-check-all"}>
                <{$systemLang.log}>
            </a>
        </li>
    </ul>
    <{* //End log tabs *}>

    <{* Tabs content *}>
    <div class="tab-content module-details">
        <div role="tabpanel" class="tab-pane fade in active" id="logger-module">
            <div class="media">
                <div class="media-left">
                    <a href="<{$xoops_url}>/modules/<{$module->getInfo('dirname')}>/<{$module->getInfo('adminindex')}>">
                        <img src="<{$xoops_url}>/modules/<{$module->getVar('dirname')}>/<{$module->getInfo('image')}>" class="media-object">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">
                        <a href="<{$xoops_url}>/modules/<{$module->getInfo('dirname')}>/<{$module->getInfo('adminindex')}>">
                            <{$module->getVar('name')}>
                        </a>
                    </h4>
                    <p>
                        <{$module->getInfo('description')}>
                    </p>

                </div>
            </div>

            <ul class="logger-module-details">
                <li>
                    <strong><{translate key='C_VERSION'}></strong>
                    <{$module->getInfo('version')}>
                </li>
                <li>
                    <strong><{translate key='C_AUTHOR'}></strong>
                    <{if $module->getInfo('author')|is_array}>
                        <{foreach item=author from=$module->getInfo('author')}>
                            <{if $author.url!=''}>
                                <a href="<{$author.url}>" target="_blank" title="<{$author.aka}>"><{$author.name}></a>
                            <{else}>
                                <span title="<{$author.aka}>"><{$author.name}></span>
                            <{/if}>
                        <{/foreach}>
                    <{else}>
                        <{$module->getInfo('author')}>
                    <{/if}>
                </li>
                <li>
                    <strong><{translate key='C_WEBSITE'}></strong>
                    <a href="<{$module->getInfo('module_website_url')}>" rel="external"><{$module->getInfo('module_website_name')}></a>
                </li>
                <li>
                    <strong><{translate key='C_LICENSE'}></strong>
                    <{$module->getInfo('license')}>
                </li>
            </ul>

            <div class="logger-buttons text-center">
                <a class="btn btn-primary" href="<{$from_link}>">
                    <{xoicon icon="xicon-modules"}>
                    <{$from_title}>
                </a>
                <{if $install|default:false}>
                    <{if $module->getInfo('hasAdmin')}>
                        <a class="btn btn-success" href="<{$xoops_url}>/modules/<{$module->getVar('dirname')}>/<{$module->getInfo('adminindex')}>">
                            <{xoicon icon="xicon-dashboard"}>
                            <{$systemLang.dashboard}>
                        </a>
                    <{/if}>
                    <{if is_array($module->getInfo('blocks'))}>
                        <a class="btn btn-orange" href="blocks.php?mid=<{$module->getVar('mid')}>">
                            <{xoicon icon="xicon-tiles"}>
                            <{$systemLang.blocks}>
                        </a>
                    <{/if}>
                    <{if is_array($module->getInfo('config'))}>
                        <a class="btn btn-indigo" href="settings.php?action=showmod&amp;mid=<{$module->getVar('mid')}>">
                            <{xoicon icon="xicon-tools"}>
                            <{$systemLang.settings}>
                        </a>
                    <{/if}>
                <{/if}>
            </div>

        </div>

        <div role="tabpanel" class="tab-pane fade in" id="logger-log">
            <div class="logger-content">

                <ul>
                    <{foreach item=top from=$log}>
                        <{if !is_array($top)}>
                            <li class="xo-step">
                                <{xoicon icon="xicon-check-all"}>
                                <{$top}>
                            </li>
                        <{else}>
                            <{foreach item=child from=$top}>
                                <li class="xo-child">
                                    <{xoicon icon="xicon-angle-right"}>
                                    <{$child}>
                                </li>
                            <{/foreach}>
                        <{/if}>
                    <{/foreach}>
                </ul>

            </div>
        </div>
    </div>
    <{* //End tabs content *}>
<{/if}>