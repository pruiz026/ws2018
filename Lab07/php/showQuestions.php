<?php
	header("Control-cache: no-store, no-cache, must-revalidate");
	session_start();
	if(!isset($_SESSION['id'])) 
	{
		echo '<script> javascript:history.go(1); </script>';
		die();
	}
?>

<!DOCTYPE html>

<html>
	<head>
		<title>Show questions</title>
		<script src="../js/jquery-3.2.1.js"></script>
		<style>
			td		 				{text-align: center;}
			
			#logInfo				{float:right; margin-top: -5px;}
			#loggedEmail			{float:left; margin-right: 20px; margin-top: 6%;}
			#argazkia				{float:right;}

			#menua					{float: left; }
			#backButton				{float: left;}

		</style>
	</head>
	
	<body>
		<div id='page-wrap'>
			<header class='main' id='h1'>
				<span class="loginekoak"><a href="logOut.php">LogOut</a> </span>
				<a id="backButton" href=javascript:history.go(-1);> <img src="../images/atrás.png" width="40" height="40"></a>
				<div id="logInfo"></div>
				<h2>Show questions</h2>
			</header>

			<nav class='main' id='n1' role='navigation'>
				<span><a href='layout.php'>Home</a></span>
				<span><a href='credits.php'>Credits</a></span>
				<span><a href='layout.php'>Quizzes</a></span>
				<span class='logeatuak'><a href='../xml/questions.xml'>XML Questions</a></li>
				<span class='logeatuak'><a href='showXMLQuestions.php'>XML Questions(PHP)</a></li>
				<span class='logeatuak'><a href='handlingQuizAJAX.php'>Handling Quiz AJAX</a></li>
			</nav>

			<section class="main" id="s1">
				<div>
					<table border="1">
						<tr id="eremuak">
							<th> ID </th>
							<th> Eposta </th>
							<th> Galdera </th>
							<th> Erantzun zuzena </th>
							<th> 1. erantzun okerra </th>
							<th> 2. erantzun okerra </th>
							<th> 3. erantzun okerra </th>
							<th> Zailtasuna </th>
							<th> Arloa </th>
							<th> Irudia </th>
						</tr>
			
						<?php						
							include("dbConfig.php");
							$linki= mysqli_connect($server, $user, $passwd, $database);
							
							if(!$linki) echo "Konexio errorea</br>";
							else {			
								$galderenTaula = $linki->query("SELECT * FROM questions");
								
								if($galderenTaula->num_rows == 0) echo "Ez dago galderarik<br>";
								while ($galdera = $galderenTaula->fetch_assoc()) {
									echo "<tr>"; 
										echo "<td>".$galdera['ID']."</td>";
										echo "<td>".$galdera['eposta']."</td>";
										echo "<td>".$galdera['galderaTestua']."</td>";
										echo "<td>".$galdera['erantzunZuzena']."</td>";
										echo "<td>".$galdera['erantzunOkerra1']."</td>";
										echo "<td>".$galdera['erantzunOkerra2']."</td>";
										echo "<td>".$galdera['erantzunOkerra3']."</td>";
										echo "<td>".$galdera['zailtasuna']."</td>";
										echo "<td>".$galdera['arloa']."</td>";
										if($galdera['irudia'] != "")
											echo "<td><img width='100' height='100' src='data:image/*;base64,".base64_encode($galdera['irudia'])."'></td>";
										else
											echo "<td><img width='100' height='100' src='../images/x.png'></td>";
									echo "</tr>";
								}
							}
						?>
					</table>
				</div>
			</section>
			<footer class='main' id='f1'>
				<a href='https://github.com'>Link GITHUB</a>
			</footer>
		</div>	
	</body>
</html>

<?php
	include("userInfo.php");
?>>
