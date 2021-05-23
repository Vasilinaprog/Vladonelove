<?php
	if($_POST["id_user"] != ""){
		$id_user = $_POST["id_user"];
		$id_book = $_POST["id_book"];
		$text = $_POST["text"];
		$id_comment = $_POST["id_comment"];
		$can_connect = $_POST["can_connect"];
		$host = 'localhost'; 
		$user = 'root'; 
		$password = 'root'; 
		$db_name = 'socialproject'; 
		$link = mysqli_connect($host, $user, $password, $db_name);
		if($_POST["type"] == "remove"){
			$sql = "DELETE FROM comments WHERE id_comment='$id_comment'"; 
			$result = $link->query($sql);
		}
		else{
			$sql = "INSERT INTO comments (id_book, id_user, text, can_connect) VALUES ('$id_book', '$id_user', '$text', '$can_connect')"; 
			$result = $link->query($sql);
		}
	}
?>