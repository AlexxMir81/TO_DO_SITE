<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Список моих дел</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="container">
		<h1>Список дел</h1>
		<form action="add.php" method="post">
			<input type="text" name="task" id="task" placeholder="Нужно сделать..." class="form-control">
			<button type="submit" name="sendTask" class="btn btn-success">Добавить задачу</button>
		</form>
		<?php
			require_once '../../config.php';
           
            if ($_GET['error']=='empty_input'){
                echo "вы не ввели задачу";
            }
             
			echo '<ul>';
			$test = 'SELECT * FROM `tasks` WHERE `id_user`='.$_SESSION['user_id'].' ORDER BY `id` DESC';
			echo $test;
			$query = $pdo->query('SELECT * FROM `tasks` WHERE `user_id`='.$_SESSION['user_id'].' ORDER BY `id` DESC');
			while($row = $query->fetch(PDO::FETCH_OBJ)) {
				echo '<li><b>'.$row->task.'</b><a href="delete.php?id='.$row->id.'"><button>Удалить</button></a></li>';
			}
			echo '</ul>';
		?>
		<a href='../../index.php'><input type='button' value='личный кабинет'></a>


	</div>
</body>
</html>