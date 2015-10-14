<{if $xo_admin_buttons|default:false}>
<div class="xo-moduleadmin-buttons<{if $xo_buttons_align != ''}> text-<{$xo_buttons_align}><{/if}>">
    <{foreach item=button from=$xo_admin_buttons}>
    <a class="btn <{$button.class}>" href="<{$button.link}>"<{foreach item=extra from=$button.extra key=en}> <{$en}>="<{$extra}>"<{/foreach}>>
        <{xoicon icon=$button.icon}>
        <{$button.title}>
    </a>
    <{/foreach}>
</div>
<{/if}>