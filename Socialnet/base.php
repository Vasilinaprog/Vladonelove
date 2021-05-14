<?php 
function connect(){ 
$host = 'localhost'; 
$user = 'root'; 
$password = 'root'; 
$db_name = 'socialproject'; 
return mysqli_connect($host, $user, $password, $db_name); 
}
function get_all_book_economic_generaldevelopment($link, $id_discipline, $id_level){
$sql = "SELECT id_book, name FROM books WHERE discipline_id ='$id_discipline' AND level_id='$id_level' "; 
$result = $link->query($sql); 
if ($result->num_rows > 0) { 
$array = array(); 
while($row = $result->fetch_assoc()) { 
array_push($array, array($row["id_book"], $row['name'])); 
} 
return $array; 

}
function get_all_book_information_for_book_by_id($link,$id){
    $sql = "SELECT description, author FROM books WHERE id_book='$id' "; 
$result = $link->query($sql); 
if ($result->num_rows > 0) { 
$array = array(); 
while($row = $result->fetch_assoc()) { 
array_push($array, array($row["decription"], $row['author'])); 
} 
return $array; 

}
}
function get_books($link,$id,$id_group){
    $sql = "SELECT description, name, author FROM books WHERE level_id=$id AND discipline_id=$id_group"; 
$result = $link->query($sql); 
if ($result->num_rows > 0) { 
$array = array(); 
while($row = $result->fetch_assoc()) { 
array_push($array, array("description" => $row["decription"], "author" => $row['author'], "name" => $row["name"])); 
} 
return $array; 

}
}
}
?>