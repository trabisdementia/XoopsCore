<div class="row">
    <div class="col-sm-6">
    <{if $xo_admin_box}>
        <{foreach item=box from=$xo_admin_box}>
            <div class="xo-panel xo-panel-green xo-admin-box <{$class}>" <{$box.extra}>>
                <div class="panel-heading">
                    <h3><{$box.title}></h3>
                </div>
                <div class="panel-body">
                    <ul class="list-unstyled">
                        <{foreach item=line from=$box.line}>
                            <li>
                                <{$line.text}>
                            </li>
                        <{/foreach}>
                    </ul>
                </div>
            </div>
        <{/foreach}>
    <{/if}>
    </div>

    <div class="col-sm-6">

    </div>
</div>

<{include file="admin:system/admin_infobox.tpl" class="xo-moduleadmin-box"}>
<div class="clear"></div>
<div class="xo-moduleadmin-config outer">
    <div class="xo-window">
        <div class="xo-window-title">
            <span class="ico ico-computer"></span>&nbsp;<{translate key="CONFIGURATION_CHECK"}>
            <a class="down" href="javascript:;">&nbsp;</a>
        </div>
        <div class="xo-window-data">
            <ul>
            <{foreach item=config from=$xo_admin_index_config}>
                <{if $config.type == 'error'}>
                <li class="red">
                    <span class="ico ico-cross"></span>&nbsp;<{$config.text}>
                </li>
                <{elseif $config.type == 'warning'}>
                <li class="orange">
                    <span class="ico ico-warning"></span>&nbsp;<{$config.text}>
                </li>
                <{else}>
                <li class="green">
                    <span class="ico ico-tick"></span>&nbsp;<{$config.text}>
                </li>
                <{/if}>
            <{/foreach}>
            </ul>
        </div>
    </div>
    <div class="clear"></div>
</div>