<?php 
	$host = 'localhost'; 
	$user = 'root'; 
	$password = 'root'; 
	$db_name = 'socialproject'; 
	$link = mysqli_connect($host, $user, $password, $db_name);
	function append_comment($id_book, $id_user, $text, $can_connect){
		global $link;
		$sql = "INSERT INTO comments (id_book, id_user, text, can_connect) VALUES ('$id_book', '$id_user', '$text', '$can_connect')"; 
		$result = $link->query($sql);
	}
	function append_user($login, $email, $password, $communication){
		global $link;
		$sql = "INSERT INTO users (login, email, communication, password) VALUES ('$login', '$email', '$communication', '$password')"; 
		$result = $link->query($sql);
	}
	function check_user($login, $password){
		global $link;
		$sql = "SELECT * FROM users WHERE email='$login' AND password='$password'"; 
		$result = $link->query($sql);
		if ($result->num_rows > 0) while($row = $result->fetch_assoc()) return array("id_user" => $row["id_user"], "login" => $row["login"], "email" => $row["email"]);
		else{
			$sql = "SELECT * FROM users WHERE login='$login' AND password='$password'"; 
			$result = $link->query($sql);
			if ($result->num_rows > 0) while($row = $result->fetch_assoc()) return array("id_user" => $row["id_user"], "login" => $row["login"], "email" => $row["email"]);
		}
		return false;
	}
	function user_exist($login){
		global $link;
		$sql = "SELECT * FROM users WHERE login='$login' OR email='$login'"; 
		$result = $link->query($sql);
		if ($result->num_rows > 0) return true;
		return false;
	}
	
	
	function get_books($id_level, $id_discipline){
		global $link;
		$sql = "SELECT * FROM books WHERE id_level='$id_level' AND id_discipline='$id_discipline'"; 
		$result = $link->query($sql); 
		if ($result->num_rows > 0) { 
			$array = array(); 
			while($row = $result->fetch_assoc()) { 
				array_push($array, array("id_book" => $row["id_book"], "description" => $row["description"], "author" => $row['author'], "name" => $row["name"])); 
			} 
			return $array; 
		}
		return false;
	}
	function get_favourite_books($id_user){
		global $link;
		$sql = "SELECT * FROM books WHERE id_book IN (SELECT id_book FROM favourite_books WHERE id_user='$id_user')"; 
		$result = $link->query($sql); 
		if ($result->num_rows > 0) { 
			$array = array(); 
			while($row = $result->fetch_assoc()) { 
				array_push($array, array("id_book" => $row["id_book"], "description" => $row["description"], "author" => $row['author'], "name" => $row["name"])); 
			}
			return $array; 
		}
		return false;
	}
	function get_book($id_book){
		global $link;
		$sql = "SELECT * FROM books WHERE id_book='$id_book'"; 
		$result = $link->query($sql); 
		if ($result->num_rows > 0) { 
			$array = array(); 
			while($row = $result->fetch_assoc()) { 
				return array("id_book" => $row["id_book"], "description" => $row["description"], "author" => $row['author'], "name" => $row["name"]); 
			} 
		}
		return false;
	}
	function get_comments($id_book){
		global $link;
		$sql = "SELECT * FROM `comments` WHERE id_book='$id_book' ORDER BY date DESC"; 
		$result = $link->query($sql); 
		if ($result->num_rows > 0) { 
			$array = array(); 
			while($row = $result->fetch_assoc()) { 
				array_push($array, array("id_user" => $row["id_user"], "id_comment" => $row["id_comment"], "id_book" => $row['id_book'], "text" => $row["text"], "can_connect" => $row["can_connect"])); 
			} 
			return $array; 
		}
		return false;
	}
	function get_user($id_user){
		global $link;
		$sql = "SELECT * FROM users WHERE id_user=$id_user"; 
		$result = $link->query($sql); 
		if ($result->num_rows > 0) { 
			while($row = $result->fetch_assoc()) { 
				return array("id_user" => $row["id_user"], "login" => $row["login"], "email" => $row["email"], "communication" => $row["communication"]); 
			} 
		}
	}
	function get_author($id_author){
		global $link;
		$sql = "SELECT name FROM authors WHERE id_author=$id_author"; 
		$result = $link->query($sql); 
		if ($result->num_rows > 0) { 
			while($row = $result->fetch_assoc()) { 
				return $row["name"]; 
			} 
		}
	}
	function get_desciplines(){
		global $link;
		$sql = "SELECT * FROM desciplines"; 
		$result = $link->query($sql); 
		if ($result->num_rows > 0) { 
			$array = array(); 
			while($row = $result->fetch_assoc()) { 
				$array[] = array("id_descipline" => $row["id_descipline"], "name" => $row["name"]); 
			} 
			return $array;
		}
	}
	function is_favourite($id_user, $id_book){
		global $link;
		$sql = "SELECT * FROM favourite_books WHERE id_user=$id_user AND id_book=$id_book"; 
		$result = $link->query($sql); 
		if ($result->num_rows > 0) { 
			return true;
		}
		return false;
	}
	
?>