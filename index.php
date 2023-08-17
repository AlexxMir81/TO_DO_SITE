<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TO DO SITE</title>
</head>
<body>
    <!--какую страницу авторизацию, или регистрации,  или личный кабинет -->
    <?php 
require_once 'config.php';

    if (!!($_SESSION['user_id']??false)) {
        $sqlrequest = $pdo->prepare("SELECT *  FROM `users` WHERE `id` = :id") ;
        $sqlrequest->execute(['id'=>$_SESSION['user_id']]);
        $user = $sqlrequest->fetch(PDO::FETCH_ASSOC);
        ?>
        <!-- отображать личный кабинет-->
        <h1>Welcome back</h1>
        <table>
            <tr>
                <?php echo '<td><img style= "width:50px;height:50px;" src="/images/'.$user['avatar_img'].'"></td>'?>
            </tr>
            <td><?php echo $user['username'];?></td>
        </table>
        <form method="post" action="/pages/auth/do_change.php" enctype="multipart/form-data">
            <input type="file" id="avatar_img" name="avatar_img">
            <input type="submit" value="Сохранить">
        </form>
        <a href='pages/to-do-list_example/index.php'><input type='button' value='посмотреть список здач'></a>
        <form method="post" action='do_logout.php'>
            <input type='submit' value='log out'>
        </form>
        <form method="post" action="/pages/auth/do_delete.php" enctype="multipart/form-data">
            <input type="submit" value="Удалить аккаунт">
        </form>
        <?php   }

    // else if (htmlspecialchars($_COOKIE["action"]) == 'registration_succesful'){// проверку хеша
    //     header('Location:pages/auth/login.php');   
    // }
    else{
    header('Location: pages/auth/login.php');}

    ?>
</body>
</html>