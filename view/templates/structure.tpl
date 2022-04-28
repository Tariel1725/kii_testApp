<body class="bg-secondary">
    <div class="container-fluid p-2 bg-dark align-items-end">
        <div class="row">
            <div class="col-1 offset-11">
                {if $adminFl == 1}
                <button class="btn btn-info" onclick="logout()">Выход</button>
                {else}
                <button class="btn btn-info" onclick="$('#loginForm').modal('show')">Авторизация</button>
                {/if}
            </div>
        </div>
    </div>
    <div class="container mt-2 p-5 bg-light h-100">
        {foreach from=$elements item=element}
        <div id = container_{$element.id} class="row">
            <div class="col-1">
                {if $element.hasChildren > 0}
                <i id="dropdown_{$element.id}" class="fa fa-angle-double-down" aria-hidden="true"></i>
                {/if}
                <img id="loadingImage_{$element.id}" class="img-fluid w-50" src="view/img/loading.gif" alt="loadig" style="display: none">
            </div>
            <div class="col-4 element" onclick="searchChildren({$element.id}, this)">
                <p>{$element.title}</p>
            </div>
        </div>
        {/foreach}
    </div>
</body>