<?php
    require_once '../../config.php';
    $sqlrequest = $pdo->prepare("DELETE FROM `users` WHERE `id`=:id") ;
    try{
        $sqlrequest->execute([
            'id'=>$_SESSION['user_id']
        ]);
    } 
    catch(PDOException $ex){
        echo $ex->getMessage();
    }
    $_SESSION['user_id'] = null;
    header('Location: ../../index.php');
?>