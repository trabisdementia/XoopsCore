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
    <ul class="nav nav-tabs" role="tablist">
        <{assign var=i value=0}>
        <{foreach item="category" from=$settingsCategories key=id}>
            <li role="presentation"<{if $i==0}> class="active"<{/if}>>
                <a href="#<{$id}>" aria-controls="profile" role="tab" data-toggle="tab" title="<{$category.name}>">
                    <{if $category.icon}>
                        <{xoicon icon=$category.icon}>
                    <{/if}>
                    <span class="caption"><{$category.name}></span>
                </a>
            </li>
            <{assign var=i value=$i+1}>
        <{/foreach}>
    </ul>

    <form name="frmSettings" id="frm-settings" method="post" action="settings.php">
    <div class="tab-content">
        <{assign var=i value=0}>
        <{foreach item="category" from=$settingsCategories key=id}>
            <div role="tabpanel" class="tab-pane<{if $i==0}> active<{/if}>" id="<{$id}>">
                <{foreach item=field from=$category.fields key=idF}>
                    <{if $field->formtype == 'hidden'}>
                        <{$form->getFieldByType($field, $xoops->module->dirname())->render()}>
                    <{else}>
                    <div class="row form-group">
                        <div class="col-sm-4">
                            <label for="<{$idF}>"><{$field->caption}></label>
                            <{if $field->description}>
                                <small class="help-block">
                                    <{$field->description}>
                                </small>
                            <{/if}>
                        </div>
                        <div class="col-sm-8">
                            <{$form->getFieldByType($field, $xoops->module->dirname())->render()}>
                        </div>
                    </div>
                    <{/if}>
                <{/foreach}>
            </div>
            <{assign var=i value=$i+1}>
        <{/foreach}>
    </div>
        <input type="hidden" name="op" id="op" value="save">
        <input type="hidden" name="dirname" id="dirname" value="<{$dirname}>">
        <{$token}>

        <div class="settings-controls">
            <button type="button" class="btn btn-lg btn-default" onclick="window.history.back(-1);"><{$systemLang.cancel}></button>
            <button type="submit" class="btn btn-lg btn-primary"><{$systemLang.submit}></button>
        </div>
    </form>
</div>
<!--// Form -->