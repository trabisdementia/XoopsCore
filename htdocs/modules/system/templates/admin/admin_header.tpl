<{if $xo_module_header}>
    <div class="xo-page-header">

        <{if $xo_module_header.icon}>
            <span class="header-icon"><{xoicon icon=$xo_module_header.icon}></span>
        <{/if}>
        <h1<{if $xo_module_header.subheading}> class="with-subheading"<{/if}>>
            <{$xo_module_header.title}>
            <{if $xo_module_header.subheading}>
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