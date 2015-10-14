<div id="cards-available-modules">
    <{foreach item=module from=$modules_list}>
        <div id="mid-<{$module->getInfo('dirname')}>" class="module-item<{if $module->getInfo('dirname') == 'system'}> system<{/if}>">

            <section>
                <div class="module-card<{if $module->getInfo('dirname') == 'system'}> bg-primary<{/if}>">
                    <div class="module-image">
                        <a class="xo-module-icon" href="<{$xoops_url}>/modules/<{$module->getInfo('dirname')}>/<{$module->getInfo('adminindex')}>">
                            <{if $logo_mode=='icons'}>
                                <{xoicon icon=$module->getInfo('icon')}>
                            <{else}>
                                <img src="../<{$module->getInfo('dirname')}>/<{$module->getInfo('image')}>" alt="<{$module->getInfo('name')}>">
                            <{/if}>
                        </a>
                    </div>
                    <div class="module-data">
                        <strong><{$module->getInfo('name')}></strong>
                        <div class="data">
                            <div><span class="bold"><{translate key='C_VERSION'}></span>&nbsp;<{$module->getInfo('version')}></div>
                        </div>
                    </div>
                </div>

                <div class="module-options">

                    <{if $module->getInfo('website')}>
                        <a href="<{$module->modinfo['website']['url']}>" target="_blank" title="<{$module->modinfo['website']['name']}>">
                            <{xoicon icon="xicon-link" class="text-orange"}>
                        </a>
                    <{/if}>

                    <a data-action="module-install" href="#" data-dirname="<{$module->getInfo('dirname')}>" title="<{$systemLang.install}>">
                        <{xoicon icon="xicon-check-bold-o" class="text-success"}>
                    </a>

                    <a href="#" data-action="module-info" data-mid="<{$module->getInfo('dirname')}>" title="<{translate key='DETAILS'}>">
                        <{xoicon icon="xicon-info-circle" class="text-info"}>
                    </a>

                </div>
            </section>
        </div>
        <{/foreach}>
</div>