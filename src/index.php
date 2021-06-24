<?php
require_once '../core/init.php';

$user = new User();


if($user->isLoggedIn()){
    Redirect::to('console');
}else{
    $user->logout();
    Redirect::to('../login/');
}




