<{if $xo_module_header}>
    <div class="xo-page-header">
        <{if $xo_module_header.icon}>
            <span class="header-icon"><{xoicon icon=$xo_module_header.icon}></span>
        <{/if}>
        <h1>
            <{$xo_module_header.title}>
            <{if $xo_module_header.subheading}>
                <small><{$xo_module_header.subheading}></small>
            <{/if}>
        </h1>
    </div>
<{/if}>