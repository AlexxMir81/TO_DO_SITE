<?php
    //логика удаления задачи
    //перенапрелние обратно на главную страницу
    $id = $_GET['id'];
    
    require_once 'C:\ospanel\domains\SPD121\config.php';
    $request = $pdo->prepare('DELETE FROM tasks WHERE `id`=:id');
    $request->execute(['id'=>$id]);
    header("Location:/pages/to-do-list_example/index.php")
?>