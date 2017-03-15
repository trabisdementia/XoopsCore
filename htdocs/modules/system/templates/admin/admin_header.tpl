<{if $xo_module_header|default:false}>
    <div class="xo-page-header">

        <{if $xo_module_header.icon|default:false}>
            <span class="header-icon"><{xoicon icon=$xo_module_header.icon}></span>
        <{/if}>
        <h1<{if $xo_module_header.subheading|default:false}> class="with-subheading"<{/if}>>
            <{$xo_module_header.title}>
            <{if $xo_module_header.subheading|default:false}>
                <small><{$xo_module_header.subheading}></small>
            <{/if}>
        </h1>

        <{if $xo_header_commands}>
            <div class="header-commands">
                <ul>
                    <{foreach item=item from=$xo_header_commands}>
                        <li><{$item.command}></li>
                    <{/foreach}>
                </ul>
            </div>
        <{/if}>

    </div>
<{/if}>