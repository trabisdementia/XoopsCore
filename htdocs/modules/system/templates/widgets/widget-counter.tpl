<{if $widget.property.orientation=='vertical'}>

    <div
            id="widget-<{$widget.id}>"
            class="widget widget-counter <{$widget.property.layout}> vertical size-<{$widget.property.size}> <{if $widget.property.layout=='solid'}> <{$widget.property.bgcolor}><{/if}>">
        <div class="row row-table">
            <div class="col-xs-12 text-center icon padding-15<{if $widget.property.layout=='split'}> <{$widget.property.bgcolor}><{/if}>">
                <{$widget.icon}>
            </div>
        </div>
        <div class="row row-table">
            <{if $widget.columns}>
                <{foreach item=col from=$widget.columns}>
                    <div class="col-xs-<{ceil(12/count($widget.columns))}> counter column padding-15">
                        <span><{$col->counter}></span>
                        <small><{$col->tagline}></small>
                    </div>
                <{/foreach}>
            <{else}>
                <div class="col-xs-12 counter padding-15">
                    <span><{$widget.counter}></span>
                    <small><{$widget.tagline}></small>
                </div>
            <{/if}>
        </div>
    </div>

<{else}>

    <div
            id="widget-<{$widget.id}>"
            class="widget widget-counter <{$widget.property.layout}> horizontal size-<{$widget.property.size}><{if $widget.property.layout=='solid'}> <{$widget.property.bgcolor}><{/if}> style-<{$widget.property.style}>">
        <div class="row row-table">
            <div class="col-xs-4 text-center icon padding-15<{if $widget.property.layout=='split'}> <{$widget.property.bgcolor}><{/if}>">
                <{$widget.icon}>
            </div>
            <div class="col-xs-8 counter padding-15">
                <span><{$widget.counter}></span>
                <small><{$widget.tagline}></small>
            </div>
        </div>
    </div>

<{/if}>