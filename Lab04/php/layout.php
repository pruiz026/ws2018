<!DOCTYPE HTML>
<html>
	<head>
	    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
		
		<title>Quizzes</title>

	    <link rel='stylesheet' type='text/css' href='../styles/style.css' />
		<link rel='stylesheet' 
			   type='text/css' 
			   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
			   href='../styles/wide.css' />
		<link rel='stylesheet' 
			   type='text/css' 
			   media='only screen and (max-width: 480px)'
			   href='../styles/smartphone.css' />
		<script>
			function irtetzeko() 
			{
				var r=confirm("Kontutik atera nahi duzu?");
				if (r==false)
				{
					return false;
				} 
				else 
				{
					return true;
				}
			}
		</script>
	</head>

 	<body onload = >
        <div id='page-wrap'>

                <header class='main' id='h1'>
                    <span class="right" style="display:none;"><a href="logOut.php">LogOut</a> </span>

                    <?php
                        include 'config.php';
                        $ePosta = $_GET['eposta']; 
                        $esteka = mysqli_connect($server, $user, $passwd, $database);
                        if ($esteka->connect_error)
                        {
                            die("Errorea konektatzerakoan: " . $esteka->connect_error);
                        }
                        $sql_Quiz = "SELECT IrudiProfil FROM erabiltzaileak WHERE Eposta='$ePosta'";
                        $ema = $esteka-> query($sql_Quiz);

                        if ($ema->num_rows > 0) 
                        {
                            echo "Erabiltzailea: ".$ePosta;
                            echo "<br>";
                            $row = $ema->fetch_assoc();
                            echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['IrudiProfil'] ).'" height="30"/> ';  
                        }       
                    ?>

                  <h2>Quiz: crazy questions</h2>
                </header>

            <nav class='main' id='n1' role='navigation'>
                <span><a href='/quizzes'>Quizzes</a></span>
                <?php
                echo "<span><a href='layout.php?eposta=$ePosta'>Home</a></span>";
                echo "<span><a href='credits.php?eposta=$ePosta'>Credits</a></span>";
                echo "<span><a href='addQuestion.php?eposta=$ePosta'>Add Question</a></span>";
                echo "<span><a href='showQuestionsWithImage.php?eposta=$ePosta'>Show Questions</a></span>";
                echo "<span><a href='../xml/questions.xml'>XML Questions</a></span>";
                echo "<span><a href='showXMLQuestions.php?eposta=$ePosta''>XML Questions (PHP)</a></span>";
                ?>
                <span><a href='logOut.php' onclick="return irtetzeko()" >Log Out</a></span>
            </nav>

            <section class="main" id="s1">
            <div>
                Quizzes and credits will be displayed in this spot in future laboratories ...
            </div>
            </section>
            <footer class='main' id='f1'>
                 <a href='https://github.com/pruiz026/ws2018'>Link GITHUB</a>
            </footer>
        </div>
	</body>
</html>
