<!DOCTYPE HTML>
<hmtl>
	<head> 
		<meta name="eduki-mota" content="text/html;" http-equiv="content-type" charset="utf-8">
		<title>Show Questions with Image PHP</title> 
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

	<body>
		<?php
			
			include 'config.php';
			$esteka = new mysqli($server, $user, $passwd, $database);
			
			if($esteka->connect_errno)
			{
				die("Connection failed: " . $esteka->connect_error);		
			}
			
			$sql = "SELECT * FROM Questions";
			
			$ema = $esteka->query($sql);
			
			echo '<table border=1><tr><th> eposta </th><th> Galdera </th><th> ErantzunaZuzena </th><th> ErantzunOkerra 1 </th><th> ErantzunOkerra2 </th><th> ErantzunOkerra3 </th><th> Zailtasuna </th><th> Arloa </th><th> Irudia </th></tr>';

			if ($ema->num_rows > 0) 
			{
				while ($row = $ema->fetch_assoc()) 
				{
					echo '<tr><td>'.$row['eposta'].'</td><td>'.$row['Galdera'].'</td><td>'.$row['ErantzunaZuzena'].'</td><td>'.$row['ErantzunOkerra1'].'</td><td>'.$row['ErantzunOkerra2'].'</td><td>'.$row['ErantzunOkerra3'].'</td><td>'.$row['Zailtasuna'].'</td><td>'.$row['Arloa'].'</td><td>'.'<img src="data:image/jpeg;base64,'.base64_encode( $row['Irudia'] ).'" width="100"/>'.'</td></tr>';
			

				}
			} 
			else 
			{
				echo "Errorea: Ez dago galderarik<br />";	
			}
			
			echo "Hasierako orrira itzultzeko: <a href='../layout.html'>Home</a><br />";
			
		?>			
		<footer class='main' id='f1'>
			 <a href='https://github.com/pruiz026/ws2018' target="_blank">Link GITHUB</a> | 
			 <a href='../layout.html'>Home</a>
		</footer>
	</body>
</html>
