<{include file="admin:system/admin_tips.tpl"}>
<{include file="admin:system/admin_buttons.tpl"}>

<!--Preferences-->
<{if $menu|default:false}>
<div class="xo-catsetting">
    <{foreach item=preferenceitem from=$preferences}>
    <a class="xo-tooltip" href="admin.php?fct=preferences&amp;op=show&amp;confcat_id=<{$preferenceitem.id}>" title="<{$preferenceitem.name}>">
        <img src="<{$preferenceitem.image}>" alt="<{$preferenceitem.name}>" />
        <span><{$preferenceitem.name}></span>
    </a>
    <{/foreach}>
    <a class="xo-tooltip" href="admin.php?fct=preferences&amp;op=showmod&amp;mod=1" title="<{translate key='SYSTEM_PREFERENCES' dirname='system'}>">
        <img src="<{xoAdminIcons 'xoops/system_mods.png'}>" alt="<{translate key='SYSTEM_PREFERENCES' dirname='system'}>" />
        <span><{translate key='SYSTEM_PREFERENCES' dirname='system'}></span>
    </a>
</div>
<{/if}>
<div class="clear">&nbsp;</div>

<!-- Form -->
<div id="settings-form">
<{foreach item="field" from=$formFields}>
    <{if 'Xoops\Form\TabTray' == $field|get_class}>

        <ul class="nav nav-tabs" role="tablist">
        <{foreach item=element from=$field->getElements() key=i}>
            <{if 'Xoops\Form\Tab' == $element|get_class}>
                <li role="presentation"<{if $i==0}> class="active"<{/if}>>
                    <a href="#<{$element->getName()}>" aria-controls="profile" role="tab" data-toggle="tab"><{$element->getCaption()}></a>
                </li>
            <{/if}>
        <{/foreach}>
        </ul>

        <div class="tab-content">
            <{foreach item=element from=$field->getElements() key=i}>
                <{if 'Xoops\Form\Tab' == $element|get_class}>
                    <div role="tabpanel" class="tab-pane<{if $i==0}> active<{/if}>" id="<{$element->getName()}>">
                        <{$element->render()}>
                    </div>
                <{/if}>
            <{/foreach}>
        </div>

    <{else}>
        <{$field->render()}>
    <{/if}>
<{/foreach}>
</div>
<!--// Form -->