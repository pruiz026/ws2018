<!DOCTYPE HTML>
<html>
	<head>
        <meta name="eduki-mota" content="text/html;" http-equiv="content-type" charset="utf-8">
        <title>Show Questions PHP</title>
        <link rel='stylesheet' type='text/css' href='../styles/style.css' />
        <link rel='stylesheet' 
	           type='text/css' 
	           media='only screen and (min-width: 530px) and (min-device-width: 481px)'
	           href='../styles/wide.css' />
        <link rel='stylesheet' 
               type='text/css' 
               media='only screen and (max-width: 480px)'
               href='../styles/smartphone.css' />
   </head>		



		<div id='page-wrap'>
				<header class='main' id='h1'>
				  <span class="right" style="display:none;"><a href="/login">LogIn</a> </span>
				  <span class="right" style="display:none;"><a href="/logout">LogOut</a> </span>
				  <h2>Show Questions</h2>
				</header>
				

					<div class="main" id="main">
					<?php 

						include 'config.php';

						$esteka = mysqli_connect($server, $user, $passwd, $database);
						if ($esteka->connect_error) 
						{
						    die("Errorea konektatzerakoan: " . $esteka->connect_error);
						}
						$sql_Quiz = "SELECT * FROM Questions";

						$ema = $esteka->query($sql_Quiz);

						echo '<table border=1><tr><th> eposta </th><th> Galdera </th><th> ErantzunaZuzena </th><th> 
						ErantzunOkerra1 </th><th> ErantzunOkerra2 </th><th> ErantzunOkerra3 </th><th> Zailtasuna </th><th> Arloa </th></tr>';

						if ($ema->num_rows > 0) 
						{
							while ($row = $ema->fetch_assoc()) 
							{
								echo '<tr><td>'.$row['eposta'].'</td><td>'.$row['Galdera'].'</td>
								<td>'.$row['ErantzunaZuzena'].'</td><td>'.$row['ErantzunOkerra1'].'</td><td>'.$row['ErantzunOkerra2'].'</td>
								<td>'.$row['ErantzunOkerra3'].'</td><td>'.$row['Zailtasuna'].'</td><td>'.$row['Arloa'].'</td></tr>';
							}
						} 
						else 
						{
							echo "Ez dago galderarik<br />";
						}

		
						mysqli_close($esteka);
						echo "Hasierako orrira itzultzeko: <a href='../layout.html'>Home</a><br />";
					?> 

		<footer class='main' id='f1'>
			 <a href='https://github.com/pruiz026/ws2018' target="_blank">Link GITHUB</a> | 
			 <a href='../layout.html'>Home</a>
		</footer>
	</div>
</body>
</html>
