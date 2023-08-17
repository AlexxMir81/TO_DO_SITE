<?php
require_once 'config.php';
function is_correct_file(){
    $upload_dir = '../../images';
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
?>
