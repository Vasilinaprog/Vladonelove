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
		<div>
			<br/>
			<div style="float:left;">
				<a href="index.php" class="button">Назад</a>
			</div>
			<div style="float:right;">
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
			<div style="clear: both;"></div>
		</div>
		
		<div style="max-width: 50%; margin:0 auto;">
			<?php
				$book = get_book($_GET["book"]);
				echo "<h1 align=center>Отзывы о книге: " . $book["name"] . "</h1>";
				if($_SESSION["login"] != "") echo
				'
				<div class="form">
				<textarea id="comment" cols="40" rows="5"></textarea>
				<label>Оставить способ связи: </label>
				<input type="checkbox" id="can_connect" checked>
				<button onclick=send_req(' . $book["id_book"] . ',' . $_SESSION["id_user"] . ',"append","")>Комменитровать</button>
				</div>
				';
				else echo "<h3 align=center>Авторизуйтесь, чтобы оставлять комментарии</h3>";
				$comments = get_comments($_GET["book"]);
				echo "<div id='comments'>";
				if($comments){
					foreach($comments as $current){
						$user = get_user($current["id_user"]);
						echo "<div id=" . $current['id_comment'] . ">";
						if($current["id_user"] == $_SESSION["id_user"]){
							echo "<button style='color: red;' onclick=send_req(" . $book["id_book"] . "," . $_SESSION["id_user"] . ",'remove'," . $current['id_comment'] . ")>Удалить комментарий </button>";
						}
						echo "<b> " . $user["login"] . "</b>";
						if($current["can_connect"] == 1) echo "(" . $user["communication"] . ")";
						echo ": <i>" . $current["text"] . "</i><br/><br/></div>";
					}
				}
				else echo "<h3 id='null_com'>Комментариев ещё нет, но это можно легко исправить!</h3>";
				echo "</div>";
			?>
		</div>
	</body>
	<script>
		async function send_req(id_book, id_user, type, num){
			let formData = new FormData();
			let can_connect = 0;
			if(num != ""){
				document.getElementById(num).remove();
				console.log(document.getElementById("comments").childElementCount);
				if(document.getElementById("comments").childElementCount == 0){
					let elem = document.createElement("h3");
					elem.id = "null_com";
					elem.innerHTML = "Комментариев ещё нет, но это можно легко исправить!";
					document.getElementById("comments").appendChild(elem);
				}
			}
			if(document.getElementById('can_connect').checked) can_connect = 1;
			formData.append('text', document.getElementById("comment").value);
			formData.append('id_book', id_book);
			formData.append('type', type);
			formData.append('id_user', id_user);
			formData.append('id_comment', num);
			formData.append('can_connect', can_connect);
			await fetch('set_comment.php', {
				method: 'POST',
				body: formData
			});
			if(num == "") location.reload();
		}
	</script>
</html>