<{if $type == 'horizontal'}>
    <div class="xo-panel xo-panel-primary">
        <{if $title != ''}>
            <div class="panel-heading">
                <h2><{$title}></h2>
            </div>
        <{/if}>
        <div class="panel-body">
            <form name="<{$name}>" id="<{$name}>" action="<{$action}>" method="<{$method}>" onsubmit="return xoopsFormValidate_<{$name}>();"<{$extra}>>

                <{foreach item=input from=$xo_input|default:[]}>
                    <{if $input.datalist != ''}>
                        <{$input.datalist}>
                    <{/if}>
                    <div class="row form-group">
                        <div class="col-sm-3">
                            <label><{$input.caption}><{if $input.required}> <span class="caption-required">*</span><{/if}></label>
                        </div>
                        <div class="col-sm-9">
                            <{$input.ele}>
                            <small class="help-block"><{$input.pattern_description}></small>
                            <{if $input.description != ''}>
                                <p class="help-block"><{$input.description}></p>
                            <{/if}>
                        </div>
                    </div>
                <{/foreach}>
                <{$hidden}>

            </form>
        </div>
    </div>

<{/if}>
<{if $type == 'vertical'}>
<form name="<{$name}>" id="<{$name}>" action="<{$action}>" method="<{$method}>" onsubmit="return xoopsFormValidate_<{$name}>();"<{$extra}>>
    <fieldset>
        <{if $title != ''}>
        <legend><{$title}></legend>
        <{/if}>
        <{foreach item=input from=$xo_input|default:[]}>
            <{if $input.datalist != ''}>
                <{$input.datalist}>
            <{/if}>
            <div class="form-group">
                <label><{$input.caption}><{if $input.required}><span class="caption-required">*</span><{/if}></label>
                <{$input.ele}>
                <{if $input.description != ''}>
                    <span class="help-block"><{$input.description}></span>
                <{/if}>
            </div>
            <p class="dsc_pattern_vertical"><{$input.pattern_description}></p>
        <{/foreach}>
        <{$hidden}>
    </fieldset>
</form>
<{/if}>

<{if $type == 'inline'}>
<form class="well form-inline" name="<{$name}>" id="<{$name}>" action="<{$action}>" method="<{$method}>" onsubmit="return xoopsFormValidate_<{$name}>();"<{$extra}>>
    <fieldset>
        <{if $title != ''}>
        <legend><{$title}></legend>
        <{/if}>
        <{foreach item=input from=$xo_input|default:[]}>
            <{if $input.datalist != ''}>
                <{$input.datalist}>
            <{/if}>
            <{if $input.caption}>
            <label><{$input.caption}><{if $input.required}><span class="caption-required">*</span><{/if}></label>
            <{/if}>
            <{$input.ele}>
            <{if $input.description != ''}>
            <span class="help-inline"><{$input.description}></span>
            <{/if}>
        <{/foreach}>
        <{$hidden}>
    </fieldset>
</form>
<{/if}>
<{$validationJS}>