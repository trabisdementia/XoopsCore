<{if $xo_admin_buttons|default:false}>
<div class="xo-moduleadmin-buttons">
    <{foreach item=button from=$xo_admin_buttons}>
    <a class="btn btn-<{$button.color}>" href="<{$button.link}>">
        <{xoicon icon=$button.icon}>
        <{$button.title}>
    </a>
    <{/foreach}>
</div>
<{/if}>