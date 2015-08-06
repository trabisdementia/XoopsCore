
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#general" aria-controls="general" role="tab" data-toggle="tab">
                <{xoicon icon="xicon-module"}>
                General
            </a>
        </li>
        <li role="presentation">
            <a href="#database" aria-controls="database" role="tab" data-toggle="tab">
                <{xoicon icon="xicon-database"}>
                DB Tables
            </a>
        </li>
        <li role="presentation">
            <a href="#blocks" aria-controls="blocks" role="tab" data-toggle="tab">
                <{xoicon icon="xicon-widgets"}>
                Blocks
            </a>
        </li>
        <li role="presentation">
            <a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">
                <{xoicon icon="xicon-tools"}>
                Options
            </a>
        </li>
    </ul>

    <div class="tab-content module-details">
        <div role="tabpanel" class="tab-pane fade in active" id="general">
            <header>
                <div class="media">
                    <div class="media-left">
                        <img src="../<{$module->getVar('dirname')}>/<{$module->getInfo('image')}>" alt="<{$module->getInfo('name')}>" class="media-object">
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading"><{$module->getVar('name')}></h4>
                        <span class="help-block"><{$module->getInfo('description')}></span>
                    </div>
                </div>
            </header>

            <div class="row">

                <div class="col-xs-6 details-item">
                    <strong><{$systemLang.version}></strong>
                    <span><{$module->getVar('version')}></span>
                </div>

                <div class="col-xs-6 details-item">
                    <strong><{$systemLang.dirname}></strong>
                    <span><{$module->getVar('dirname')}></span>
                </div>

            </div>

            <div class="row">

                <div class="col-xs-6 details-item">
                    <strong><{$systemLang.authors}></strong>
                            <span class="authors">
                                <{if is_array($module->getInfo('author'))}>
                                    <{foreach item=author from=$module->getInfo('author')}>
                                        <a href="<{if $author.url != ''}><{$author.url}><{elseif $author.email != ''}>mailto:<{$author.email}><{else}>#<{/if}>" target="_blank" title="<{$systemLang.author_aka|sprintf:$author.name:$author.aka}>">
                                            <img src="http://www.gravatar.com/avatar/<{if $author.email != ''}><{$author.email|md5}><{else}><{"`$author.aka`@xoops.org"|md5}><{/if}>?s=60&d=<{cycle values="wavatar,identicon,monsterid,retro"}>&r=g">
                                        </a>
                                    <{/foreach}>
                                <{else}>
                                    <{$module->getInfo('author')}>
                                <{/if}>
                            </span>
                </div>

                <div class="col-xs-6 details-item">
                    <strong><{$systemLang.license}></strong>
                    <span><{$module->getInfo('license')}></span>
                </div>

            </div>

            <div class="module-links">
                <ul>
                    <{if $module->getInfo('help')}>
                        <li>
                            <a href="<{$module->getInfo('help')}>" target="_blank" class="text-orange" title="<{$systemLang.help}>">
                                <{xoicon icon="xicon-help"}>
                            </a>
                        </li>
                    <{/if}>
                    <{foreach item=link from=$module->getInfo('links')}>
                        <li>
                            <a href="<{$link.url}>" target="_blank" title="<{$link.caption}>">
                                <{xoicon icon=$link.icon}>
                            </a>
                        </li>
                    <{/foreach}>
                    <{if $module->getInfo('website')}>
                        <{assign var="website" value=$module->getInfo('website')}>
                        <li>
                            <a href="<{$website.url}>" target="_blank" class="text-green" title="<{$website.name}>">
                                <{xoicon icon="xicon-world"}>
                            </a>
                        </li>
                    <{/if}>
                </ul>
            </div>

        </div>
        <div role="tabpanel" class="tab-pane fade" id="database">Database</div>
        <div role="tabpanel" class="tab-pane fade" id="blocks">Blocks</div>
        <div role="tabpanel" class="tab-pane fade" id="settings">Settings</div>
    </div>
