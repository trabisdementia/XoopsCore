<div id="cards-installed-modules">
    <{foreach item=module from=$modules_list}>
        <div id="mid-<{$module->getVar('mid')}>" class="module-item<{if $module->getVar('dirname') == 'system'}> system<{/if}>">

            <section>
                <div class="module-card<{if $module->getVar('dirname') == 'system'}> bg-primary<{/if}>">
                    <div class="module-image">
                        <a class="xo-module-icon" href="<{$xoops_url}>/modules/<{$module->getVar('dirname')}>/<{$module->getInfo('adminindex')}>">
                            <{if $logo_mode=='icons'}>
                                <{xoicon icon=$module->getInfo('icon')}>
                            <{else}>
                                <img src="../<{$module->getVar('dirname')}>/<{$module->getInfo('image')}>" alt="<{$module->getVar('name')}>">
                            <{/if}>
                        </a>
                    </div>
                    <div class="module-data">
                        <div id="<{$module->getVar('mid')}>" class="name rename"><{$module->getVar('name')}></div>
                        <div class="data">
                            <div><span class="bold"><{translate key='C_VERSION'}></span>&nbsp;<{$module->getInfo('version')}></div>
                            <div><span class="bold"><{translate key='C_LAST_UPDATE'}></span>&nbsp;<{$module->getInfo('update')}></div>
                        </div>
                    </div>
                </div>

                <div class="module-options">

                    <{if $module->getInfo('can_disable')}>
                        <a href="#" onclick="module_Uninstall(<{$module->getVar('mid')}>)" title="<{translate key='A_UNINSTALL'}> <{$module->getVar('name')}>">
                            <{xoicon icon="xicon-minus-circle-o" class="text-danger"}>
                        </a>
                        <a id="active-<{$module->getVar('mid')}>" href="#" onclick="module_Disable(<{$module->getVar('mid')}>,'<{translate key='A_ENABLE'}>','<{translate key='A_DISABLE'}>');" title="<{translate key='ENABLE_DISABLE'}> <{$module->getVar('name')}>">
                            <{if $module->getVar('isactive')}><{xoicon icon="xicon-pause-circle" class="text-warning"}><{else}><{xoicon
                            icon="xicon-play-circle" class="text-success"}><{/if}>
                        </a>
                    <{/if}>
                    <a href="#" onclick="module_Update(<{$module->getVar('mid')}>)" title="<{translate key='A_UPDATE'}> <{$module->getVar('name')}>">
                        <{xoicon icon="xicon-update" class="text-green"}>
                    </a>

                    <a href="#" data-action="module-info" data-mid="<{$module->getVar('mid')}>" title="<{translate key='DETAILS'}>">
                        <{xoicon icon="xicon-info-circle" class="text-info"}>
                    </a>

                </div>
            </section>
        </div>
        <{/foreach}>
</div>