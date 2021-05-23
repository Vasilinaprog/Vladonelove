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
		<?php echo '<a href="select_discipline.php?level=' . $_GET["level"] . '" class="button" >Назад</a>' ?> 
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
		
			<?php
				$books = get_books($_GET["level"], $_GET["discipline"]);
				if($books){
					foreach($books as $current){
						echo '<div style="max-width: 50%; margin:0 auto; background:white;">';
						echo '<div style="max-width: 90%; margin:0 auto;">';
						echo "<h2>" . $current["name"] . " - " . get_author($current["author"]) . "</h2><br/>";
						echo "<label>" . $current["description"] . "</label><br/>";
						echo "<a href=comments.php?book=" . $current["id_book"] . " class=small_button>Комментарии</a><br/>";
						if($_SESSION["login"] != ""){
							$star = "&#9734";
							$value = 0;
							if(is_favourite($_SESSION["id_user"], $current["id_book"])){
								$star = "&#10029";
								$value = 1;
							}
							echo "<button onclick='send_req(this.value," . $current["id_book"] . "," . $_SESSION["id_user"] . ")' value=$value id=" . $current["id_book"] . ">$star</button><br/><br/>";
						}
						echo "</div></div>";
					}
				}
				else echo "<h2>тут пока ничего нет</h2>";
			?>
	</body>
	<script>
		async function send_req(val, id_book, id_user){
			let button = document.getElementById(id_book);
			if(val == 0){
				button.value = 1;
				button.innerHTML  = "&#10029";
			}
			else{
				button.value = 0;
				button.innerHTML  = "&#9734";
			}
			let formData = new FormData();
			formData.append('value', val);
			formData.append('id_book', id_book);
			formData.append('id_user', id_user);
			let res = await fetch('set_favourite.php', {
				method: 'POST',
				body: formData
			});
		}
	</script>
</html>