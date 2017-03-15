<{if $xo_breadcrumb|default:false}>
    <ol class="breadcrumb" id="<{$xo_breadcrumb_id}>">
        <li>
            <a href="<{$xoops_cp_url}>">
                <{xoicon icon="xicon-home"}>
            </a>
        </li>
        <{foreach item=crumb from=$xo_breadcrumb key=i}>
            <{if $crumb.link|default:false}>
                <li<{if $crumb.params.class|default:false}> class="<{$crumb.params.class}>"<{/if}>>
                    <a href="<{$crumb.link}>"<{foreach item=attr from=$crumb.params key=name}><{if $name!='class'}> <{$name}>="<{$attr}>"<{/if}><{/foreach}>>
                    <{$crumb.caption}>
                    </a>
                </li>
            <{else}>
                <li class="active">
                    <{$crumb.caption}>
                </li>
            <{/if}>
        <{/foreach}>
    </ol>
<{/if}>