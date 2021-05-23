<?php
	session_start();
	require_once "base.php";
?>
<html lang="ru" xml:lang="ru">
	<head>
		<title> </title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
		<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
	</head>
	
	<body>
	<br/>
	<div style="float:left;">
	<a href="index.php" class="button">Назад</a>
	</div>
	
		<div align="right">
			<?php
				if($_SESSION["login"] == "") echo 
				'<div>
				<a href="login.php" class="button">Вход</a>
				<a href="registration.php" class="button">Регистрация</a>
				</div>';
				else echo 
				'<div>
				<a href="profile.php" class="button">' . $_SESSION["login"] . '</a>
				<a href="logout.php" class="button">Выход</a>
				</div>';
			?>
		</div>
		<div align="center" style="margin-top: 20%">
			<?php
				$desciplines = get_desciplines();
				foreach($desciplines as $current){
					echo"<a href=discipline.php?level=" . $_GET['level'] . "&discipline=" . $current["id_descipline"] . " title='' class='button'>" . $current["name"] . "</a> ";
				}
			?>
		</div>
	</body>
</html>