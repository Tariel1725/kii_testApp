function readCookie(name) {
    let name_cook = name + "=";
    let spl = document.cookie.split(";");

    for (let i = 0; i < spl.length; i++) {
        let c = spl[i];
        while (c.charAt(0) == " ") {
            c = c.substring(1, c.length);
        }
        if (c.indexOf(name_cook) == 0) {
            return c.substring(name_cook.length, c.length);
        }
    }
}

function login(){
    let login = document.getElementById('loginForm').value;
    let pwd = md5(document.getElementById('passwordForm').value);
    $.ajax({
        type: 'POST',
        url: 'back/controller.php?action=login',
        method: 'post',
        dataType: 'html',
        data: {login:login, pwdHash:pwd},
        success: function(data) {
            if(data.length!==4){
                let userData = JSON.parse(data);
                document.cookie = "sessionKey="+userData['session'];
                document.cookie = "userId="+userData['userId'];
                window.location.reload();
            }
            else {
                document.getElementById('LoginFormTitle').innerText = 'Логин или пароль не верны';
            }
        },
    });
}

function logout(){

}

function searchChildren(parentId, el){
    //Здесь мог бы быть некий шаблонизатор, но так как у нас только единожды применяется построение шаблона со стороны JS добавлять в проект шаблонизатор не хотелось
    if ( el.parentNode.hasAttribute('opened') ) {
        el.parentNode.removeAttribute('opened');
        el.parentNode.lastElementChild.remove();
    }
    else {
        $('#loadingImage_'+parentId).show();
        $.ajax({
            type: 'POST',
            url: 'back/controller.php?action=elementsList',
            method: 'post',
            dataType: 'html',
            data: {parentId: parentId},
            success: function (data) {
                if (data.length !== 4) {
                    let elements = JSON.parse(data);
                    let parentDiv = el.parentNode;
                    parentDiv.setAttribute('opened', 'true');

                    let container = document.createElement('div');
                    container.id = 'container_' + parentId;
                    container.classList.add('col-11', 'offset-1')

                    for (let x = 0; x < elements.length; x++) {
                        let row = document.createElement('div');
                        row.classList.add('row');
                        let pDiv = document.createElement('div');
                        let iDiv = document.createElement('div');
                        let p = document.createElement('p')
                        let i = document.createElement('i');

                        pDiv.classList.add('col-4', 'element');
                        iDiv.classList.add('col-1');

                        p.innerText = elements[x]['title'];

                        if (elements[x]['hasChildren'] > 0) {
                            pDiv.setAttribute('onclick', 'searchChildren('+elements[x]['id']+', this)')
                            i.classList.add('fa', 'fa-angle-double-down');
                            i.setAttribute('aria-hidden', 'true')

                            let img = document.createElement('img');
                            img.src = 'view/img/loading.gif';
                            img.alt = 'loading';
                            img.classList.add('img-fluid', 'w-50');
                            img.id = 'loadingImage_'+elements[x]['id'];
                            img.setAttribute('style', 'display: none;')
                            iDiv.appendChild(i);
                            iDiv.appendChild(img);
                        }

                        pDiv.appendChild(p);
                        row.appendChild(iDiv);
                        row.appendChild(pDiv);
                        container.appendChild(row);
                    }
                    parentDiv.appendChild(container);
                    $('#loadingImage_'+parentId).hide();
                }
            },
        });
    }
}

function editFormFill(id){

}