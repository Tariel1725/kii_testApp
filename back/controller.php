<?php
require_once 'users.php';
require_once 'elements.php';

//Использовал switch-case для экономии времени, чтобы не городить полноценный контроллер на десяток методов тестового задания
switch ($_GET['action']){
    case 'login':
        if(isset($_POST['login'])){
            $user = new users();
            $user->login = $_POST['login'];
            $user->password = $_POST['pwdHash'];
            $result['session'] = $user->logIn();
            $result['userId'] = $user->id;
            echo json_encode($result);
        }
        break;
    case 'checkSession':
        if(isset($_POST['sessionKey'])){
            $user = new users();
            $user->sessionKey = $_POST['sessionKey'];
            $user->id = $_POST['userId'];
            $result = $user->checkSession();
            echo $result;
        }
        break;
    case 'elementsList':
        $elements = new elements();
        if(isset($_POST['parentId'])){
            $elements->parentId = $_POST['parentId'];
        }
        echo json_encode($elements->elementsList($elements->parentId));
        break;
    case 'createElement':
        $elements = new elements();
        $elements->title = $_POST['title'];
        $elements->description = $_POST['description'];
        $elements->parentId = $_POST['parentId'];
        echo $elements->createElement();
        break;
    case 'updateElement':
        $elements = new elements();
        $elements->title = $_POST['title'];
        $elements->description = $_POST['description'];
        $elements->parentId = $_POST['parentId'];
        $elements->id = $_POST['id'];
        $elements->updateElement();
        break;
    case 'deleteElement':
        $elements = new elements();
        $elements->id = $_POST['id'];
        $elements->deleteElement();
        break;
}
