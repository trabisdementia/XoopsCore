<{if $command=='view-mode'}>
    <div class="btn-group" data-toggle="buttons" role="group" aria-label="...">
        <label class="btn btn-default<{if $view_view=='list'}> active<{/if}>">
            <input type="radio" name="view_mode" data-mode="list" autocomplete="off"<{if $view_view=='list'}> checked<{/if}>>
            <{xoicon icon="xicon-list"}>
        </label>
        <label class="btn btn-default<{if $view_view=='cards'}> active<{/if}>">
            <input type="radio" name="view_mode" data-mode="cards" autocomplete="off"<{if $view_view=='cards'}> checked<{/if}>>
            <{xoicon icon="xicon-modules"}>
        </label>
    </div>
<{elseif $command=='logo-mode'}>
    <div class="btn-group" data-toggle="buttons" role="group" aria-label="...">
        <label class="btn btn-default<{if $view_logo=='images'}> active<{/if}>">
            <input type="radio" name="view_logo" data-mode="images" autocomplete="off"<{if $view_logo=='images'}> checked<{/if}>>
            <{xoicon icon="xicon-image-landscape"}>
        </label>
        <label class="btn btn-default<{if $view_logo=='icons'}> active<{/if}>">
            <input type="radio" name="view_logo" data-mode="icons" autocomplete="off"<{if $view_logo=='icons'}> checked<{/if}>>
            <{xoicon icon="xicon-apps"}>
        </label>
    </div>
<{/if}>