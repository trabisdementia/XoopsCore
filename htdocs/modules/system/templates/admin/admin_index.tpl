<div class="row">
    <div class="col-sm-8">
    <{if $xo_admin_box}>
        <{foreach item=box from=$xo_admin_box}>
            <div class="xo-panel xo-panel-green xo-admin-box <{$class}>" <{$box.extra}>>
                <div class="panel-heading">
                    <h3><{$box.title}></h3>
                </div>
                <div class="panel-body">
                    <ul class="xo-list list-circle">
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

    <div class="col-sm-4">

    </div>
</div>

<div class="xo-panel xo-config-box">
    <div class="panel-heading">
        <h3>
            <{xoicon icon="xicon-check-all"}>
            <{translate key="CONFIGURATION_CHECK"}></h3>
    </div>
    <div class="panel-body">
        <ul class="xo-list list-check">
            <{foreach item=config from=$xo_admin_index_config}>
                <{if $config.type == 'error'}>
                    <li class="cross danger text-danger">
                        <{$config.text}>
                    </li>
                <{elseif $config.type == 'warning'}>
                    <li class="warning text-warning">
                        <{$config.text}>
                    </li>
                <{else}>
                    <li class="success text-green">
                        <{$config.text}>
                    </li>
                <{/if}>
            <{/foreach}>
        </ul>
    </div>
</div>