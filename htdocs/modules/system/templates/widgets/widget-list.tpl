<div class="xo-panel widget widget-list" id="<{$widget.id}>">
    <div class="panel-heading">
        <{if $widget.collapse}><button class="collapse"></button><{/if}>
        <{if $widget.tools}>
            <ul class="tools">
                <{foreach item=tool from=$widget.tools}>
                    <li>
                        <a href="<{$tool.link}>"<{if $tool.type=='button'}> class="btn <{$tool.class}>"<{/if}>>
                            <{$tool.content}>
                        </a>
                    </li>
                <{/foreach}>
            </ul>
        <{/if}>
        <h3><{$widget.title}></h3>
    </div>
    <div class="table-responsive<{if $widget.collapse}> collapsable<{/if}>">
        <table class="table the-list">
            <{foreach item=item from=$widget.items}>
                <tr>
                    <{foreach item=column from=$item}>
                        <td>
                            <{$column}>
                        </td>
                    <{/foreach}>
                </tr>
            <{/foreach}>
        </table>
    </div>
</div>