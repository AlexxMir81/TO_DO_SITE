<?php

require_once '../../config.php';

require_once '../../function.php';

$sqlrequest = $pdo->prepare("SELECT *  FROM `users` WHERE `username` = :username") ;
$sqlrequest->execute(['username'=>$_POST ['username']]);
if ($sqlrequest->rowCount() > 0){
    echo "username has already used";

}
else{

    // validation block
    $sqlrequest = $pdo->prepare("INSERT INTO `users`(`username`,`password`,`avatar_img`) VALUES(:username, :password, :avatar_img)") ;
    $sqlrequest->execute([
        'username'=>is_correct_username(),
        'password'=>is_correct_password(),
        'avatar_img'=>is_correct_file()/
    ]);
    setcookie('action','registration_succesful');/
header('Location: ../auth/login.php');
}