<{if $xo_toolbar_tools}>
    <div class="xo-toolbar">
        <ul class="tools">
            <{foreach item=tool from=$xo_toolbar_tools}>
                <li>
                    <a <{$tool.attributes}>>
                        <{xoicon icon=$tool.icon}>
                        <span class="caption"><{$tool.caption}></span>
                    </a>
                </li>
            <{/foreach}>
        </ul>
    </div>
<{/if}>