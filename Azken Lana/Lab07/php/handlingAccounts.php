<?php
	header("Control-cache: no-store, no-cache, must-revalidate");
	session_start();
	if(!isset($_SESSION['rola'])) 
	{
		echo '<script> javascript:history.go(1); </script>';
		die();
	}
	else if($_SESSION['rola'] != "admin") 
	{
		echo '<script> javascript:history.go(-1); </script>';
		die();
	}
?>

<!DOCTYPE html>

<hmtl>
    <head> 
        <meta name="eduki-mota" content="text/html;" http-equiv="content-type" charset="utf-8">
        <title>Handling Accounts</title>
        <link rel='stylesheet' type='text/css' href='../styles/style.css' />
        <link rel='stylesheet' 
               type='text/css' 
               media='only screen and (min-width: 530px) and (min-device-width: 481px)'
               href='../styles/wide.css' />
        <link rel='stylesheet' 
               type='text/css' 
               media='only screen and (max-width: 480px)'
               href='../styles/smartphone.css' />

         <script src="../js/jquery-3.2.1.js"></script>
         <script src="../js/erabiltzaileaBlokeatu.js"></script>
         <script src="../js/erabiltzaileaEzabatu.js"></script>
         <style>
         	section{width: 85%; height: 820px;}
         </style>


	</head>

	<body>
	
	    <div id='page-wrap'>
	    	<header class='main' id='h1'>
				<span class="loginekoak"><a href="logOut.php">LogOut</a> </span>
				<div id="logInfo"></div>
				<h2>Handling Accounts</h2>
			</header>

			<nav class='main' id='n1' role='navigation'>
				<span><a href='layout.php'>Home</a></span>
				<span><a href='credits.php'>Credits</a></span>
				<span><a href='layout.php'>Quizzes</a></span>
			</nav>	


			<section class="main" id="s1">
				<div>
				<form id="form" name="form" action="" method="post" enctype='multipart/form-data'>
					Erabiltzailearen eposta (*): <input type="text" class="input" id="erabiltzailea" name="erabiltzailea" size="50"  value="XXX000@ikasle.ehu.eus" required pattern="^([a-z]{2,})([0-9]{3})@ikasle\.ehu\.eus$"/> </br></br>
					
					<input type="button" id="blokeatu" name="blokeatu" value="Blokeatu/Desblokeatu" onclick="eBlokeatu()"/>
					<input type="button" id="ezabatu" name="ezabatu" value="Ezabatu" onclick="eEzabatu()"/></br></br>
					<input type="button" value="Refresh" onClick="window.location.reload()">
					<br/><br/>
				</form>
				<div id="mezuaAJAX"></div>
				</div>

				<center>
				<table border="1">
					<tr id="eremuak">
						<th> ID </th>
						<th> Blokeatuta </th>
						<th> Eposta </th>
						<th> Pasahitza </th>
						<th> Irudia </th>
					</tr>	
					<?php
						include("dbConfig.php");
						$linki= mysqli_connect($server, $user, $passwd, $database);
						
						if(!$linki) echo "Konexio errorea</br>";
						else 
						{			
							$erabiltzaileenTaula = $linki->query("SELECT * FROM users");
							
							if($erabiltzaileenTaula->num_rows == 0) echo "Ez dago erabiltzailerik<br>";
							while ($erabiltzaileak = $erabiltzaileenTaula->fetch_assoc()) 
							{
								echo "<tr>"; 
									echo "<td>".$erabiltzaileak['ID']."</td>";
									echo "<td>".$erabiltzaileak['blokeatuta']."</td>";
									echo "<td>".$erabiltzaileak['eposta']."</td>";
									echo "<td>".$erabiltzaileak['pasahitza']."</td>";
									if($erabiltzaileak['argazkia'] != "")
										echo "<td><img width='100' height='100' src='data:image/*;base64,".base64_encode($erabiltzaileak['argazkia'])."'></td>";
									else
										echo "<td><img width='100' height='100' src='../images/x.png'></td>";
								echo "</tr>";
							}
						}
					?>
				</table>
				</center>
			</section>


			<footer class='main' id='f1'>
				 <a href='https://github.com/pruiz026/ws2018' target="_blank">Link GITHUB</a> 			
			</footer>
	</body>
</html>

<?php
	include("userInfo.php");
?>