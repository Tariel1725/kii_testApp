<head>
    <title>TestApplication</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-grid.css" rel="stylesheet">
    <link href="css/bootstrap-reboot.css" rel="stylesheet">
    <link href="css/bootstrap-utilities.css" rel="stylesheet">
    <link href="css/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/md5.js"></script>
</head>

<?php
require_once 'view/smarty/libs/Smarty.class.php';
require_once 'back/elements.php';
require_once 'back/users.php';
$users = new users();
$elements = new elements();
$smarty = new Smarty();

$smarty->setTemplateDir('view/templates/');
$smarty->setCompileDir('view/templates_c/');
$smarty->setConfigDir('view/configs/');
$smarty->setCacheDir('view/cache/');

if(isset($_COOKIE['sessionKey'])&&isset($_COOKIE['userId'])){
    $users->sessionKey = $_COOKIE['sessionKey'];
    $users->id = $_COOKIE['userId'];
    $adminFl = 0;
    if($users->checkSession()>0){
        $adminFl = 1;
    }
}
else{
    $adminFl = 0;
}
$smarty->assign('adminFl', $adminFl);
$elements = $elements->elementsList();
$smarty->assign('elements', $elements);

$smarty->display('structure.tpl');
