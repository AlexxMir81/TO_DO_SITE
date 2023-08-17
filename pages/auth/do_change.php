<?php
require_once '../../config.php';
require_once '../../function.php';
$sqlrequest = $pdo->prepare("UPDATE `users` SET `avatar_img`=:avatar_img WHERE `id`=:id") ;

try{
    $sqlrequest->execute([
            'id'=>$_SESSION['user_id'],
            'avatar_img'=>is_correct_file()
        ]);
} 
catch(PDOException $ex){
    echo $ex->getMessage();
}
header('Location: ../../index.php');

?>