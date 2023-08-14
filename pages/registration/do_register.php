<?php

//ПЛАН
// подключить бд
// есть ли пользователь в бд?
// validation
// создаем пользователя

require_once 'C:\ospanel\domains\SPD121\config.php';

function is_correct_file(){
    $upload_dir = 'C:\ospanel\domains\SPD121\images\\';
    #$_FILES['name_attribute from form']['name']
    $upload_filename = $upload_dir.basename($_FILES['avatar_img']['name']); // only filename - basename($_FILES['avatar_img']['name']) -> name.png
    //echo $_FILES['avatar_img']['name']."<br>".$_FILES['avatar_img']['type']."<br>";
    //print_r($_FILES);
    if ($_FILES['avatar_img']['type'] != 'image/jpeg'  && $_FILES['avatar_img']['type'] != 'image/png' && $_FILES['avatar_img']['type'] != 'image/gif'){
        echo "type must be only jpg, gif or png";
        die; //
    }

    if($_FILES['avatar_img']['size'] > 5*1024*1024) {
        echo "size should be 5 MB or lower";
        die; //остановка выполнения дальнейшего скрипта
    }
    
    //Подумать над изменение названия изображения на сервере
    if (move_uploaded_file($_FILES['avatar_img']['tmp_name'], $upload_filename)){
        return basename($_FILES['avatar_img']['name']);
    }
    echo 'smth wrong';
    die;
}

function is_correct_username(){
    //проверку sql инъекции ДОБАВИТЬ
    if (strlen($_POST['username']) <= 10 && strlen($_POST['username']) >= 4){
    return $_POST['username'];
    }
    echo "username must be from 4  to 10 symbols " ;
    die; //остановка выполнения дальнейшего скрипта

}

function is_correct_password(){
    if (strlen($_POST['password']) <= 10 && strlen($_POST['password']) >= 4){
        //проверку на сильный пароль
        return password_hash($_POST['password'],PASSWORD_DEFAULT);
        }
    echo "username must be from 4  to 10 symbols " ;
    die; //остановка выполнения дальнейшего скрипта

}

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
        'password'=>is_correct_password(),//password -  хеширование -> хэш всегда будет фиксированной длины
        'avatar_img'=>is_correct_file()// file
    ]);
    setcookie('action','registration_succesful');// задавать куки лучше через hash
header('Location: ../auth/login.php');
}