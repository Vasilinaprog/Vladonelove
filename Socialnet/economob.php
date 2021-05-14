<!DOCTYPE html>


<html lang="ru" xml:lang="ru">
<head>
<title> </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<link rel="stylesheet" type="text/css" href="css1.css" media="screen" />
</head>
<?php
	   require_once "base.php";
	   $link = connect();
?>
<body>

<div id="container">


	<div id="header"><div class="headtitle"> Обществознание</div></div>



	<div id="menu">
		<ul>
				<li><a id="is_active">Экономика</a></li>
			<li><a href="pravob.php" title="">Право</a></li>
      <li><a href="last_page.php" title="">Политология</a></li>
      <li><a href="last_page.php" title="">Социология</a></li>
    	<li><a href="second_page.php" title="">Профиль</a></li>
		</ul>
	</div>

	

	<div id="content">
	
		<div id="insidecontent">
			
		
			
			<?php
				if($_GET["name"] == 'ege') $level = 1;
				else if($_GET["name"] == 'olymp') $level = 2;
				else if($_GET["name"] == 'main') $level = 3;
				$books = get_books($link, $level, 1);
				foreach($books as $current){
					echo "<h1>$current['name']</h1>";
					echo "<p>$current['description']<p>";
				}
			?>
		
    
		</div>

		
	
		<div style="clear: both;"></div>
	
		
	</div>
	
	

	
</div>
</body>
</html>