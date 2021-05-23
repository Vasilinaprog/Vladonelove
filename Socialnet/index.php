<?php 
	session_start();
?>
<html>
	<head>
		<link rel="stylesheet" href="style.css"/>
	</head>
	// <style>
	// 	body {background:background.jpg;}
	// </style>
	<body style="style.css">
		<br/>
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
			<a href="select_discipline.php?level=1" title="" class="button">Для начининающих</a>
			<a href="select_discipline.php?level=2" title="" class="button">Для подготовки к олимпиадам</a>
			<a href="select_discipline.php?level=3" title="" class="button">Для общего развития</a>
		</div>
	</body>
</html>