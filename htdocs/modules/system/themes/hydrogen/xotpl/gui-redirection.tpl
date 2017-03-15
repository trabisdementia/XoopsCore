<{if $hydrogen.redirection|default:false}>
    <script type="text/javascript">
        (function($){
            $(document).ready(function(){
                xoops.notify({
                    text: '<{$hydrogen.redirection.message}>',
                    addclass: '<{if $hydogen.redirection.type!=''}><{$hydrogen.redirection.type}><{else}>alert-warning<{/if}>',
                    icon: '<{if $hydrogen.redirection.icon!=''}><{$hydrogen.redirection.icon}><{else}>xicon-alert<{/if}>',
                    opacity: 1
                });
            });
        }(jQuery));
    </script>
<{/if}>
