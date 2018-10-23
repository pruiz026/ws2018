<!DOCTYPE HTML>
<hmtl>
	<head> 
		<title>Show Questions</title> 
		<meta charset="UTF-8">
	</head>

	<body>
		<?php
			
			include 'config.php';
			$esteka = new mysqli($server, $user, $passwd, $database);
			
			if($esteka->connect_errno)
			{
				die("Connection failed: " . $esteka->connect_error);		
			}
			echo "Konexioa egin da:" .$esteka->host_info;
			
			$sql = "SELECT * FROM Questions";
			
			$ema = $esteka->query($sql_Quiz);
			
			echo '<table border=1><tr><th> ID </th><th> eposta </th><th> Galdera </th><th> Erantzun Zuzena </th><th> Erantzun Okerra 1 </th><th> Erantzun Okerra 2 </th><th> Erantzun Okerra 3 </th><th> Zailtasuna </th><th> Arloa </th><th> Irudia </th></tr>';

			if ($ema->num_rows > 0) 
			{
				while ($row = $ema->fetch_assoc()) 
				{
					echo '<tr><td>'.$row['ID'].'</td> <td>'. $row['eposta'].'</td><td>'.$row['Galdera'].'</td>
					<td>'.$row['ErantzunZuzena'].'</td><td>'.$row['ErantzunOkerra1'].'</td><td>'.$row['ErantzunOkerra2'].'</td>
					<td>'.$row['ErantzunOkerra3'].'</td><td>'.$row['GalderaZailtasuna'].'</td><td>'.$row['GalderaArloa'].'</td><td>'.$row['Irudia'].'</td></tr>';
				}
			} 
			else 
			{
				echo "Errorea: Ez dago galderarik";	
			}
			
			echo "Hasierako orrira itzultzeko: <a href='../layout.html'>Home</a>";
			
		?>			
		<footer class='main' id='f1'>
			 <a href='https://github.com/pruiz026/ws2018' target="_blank">Link GITHUB</a> | 
			 <a href='../layout.html'>Home</a>
		</footer>
	</body>
</html>