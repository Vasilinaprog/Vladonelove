<?php 
	session_start();
	require_once "base.php";
	if($_SESSION["login"] == "") header('Location: index.php');
?>
<html>
	<head>
		<link rel="stylesheet" href="style.css">
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
		<div style="max-width: 40%; margin:0 auto;">
			<?php
				$books = get_favourite_books($_SESSION["id_user"]);
				if($books){
					foreach($books as $current){
						echo "<div id=div_" . $current["id_book"] . ">";
						echo "<h2>" . $current["name"] . " - " . get_author($current["author"]) . "</h2><br/>";
						echo "<label>" . $current["description"] . "</label><br/>";
						echo "<a href=comments.php?book=" . $current["id_book"] . " class=small_button>Комментарии</a><br/>";
						echo "<button onclick='send_req(this.value," . $current["id_book"] . "," . $_SESSION["id_user"] . ")' value=1 id=" . $current["id_book"] . ">&#10029</button><br/><br/>";
						echo "</div>";
					}
				}
				else echo "<h2 align='center'>В вашей библиотеке ещё нет книг</h2>";
			?>
		</div>
	</body>
	
	<script>
		async function send_req(val, id_book, id_user){
			document.getElementById("div_" + id_book).remove();
			let formData = new FormData();
			formData.append('value', val);
			formData.append('id_book', id_book);
			formData.append('id_user', id_user);
			await fetch('set_favourite.php', {
				method: 'POST',
				body: formData
			});
		}
	</script>
</html>




