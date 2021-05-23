<?php
	if($_POST["value"] != ""){
		$id_user = $_POST["id_user"];
		$id_book = $_POST["id_book"];
		$host = 'localhost'; 
		$user = 'root'; 
		$password = 'root'; 
		$db_name = 'socialproject'; 
		$link = mysqli_connect($host, $user, $password, $db_name);
		if($_POST["value"] == 1){
			$sql = "DELETE FROM favourite_books WHERE id_book='$id_book' AND id_user='$id_user'"; 
			$result = $link->query($sql);
		}
		else{
			$sql = "INSERT INTO favourite_books (id_book, id_user) VALUES ('$id_book', '$id_user')"; 
			$result = $link->query($sql);
		}
	}
?>