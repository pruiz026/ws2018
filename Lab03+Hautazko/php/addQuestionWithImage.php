<?php
     $ePosta=$_GET["eposta"];
?>
<!DOCTYPE HTML>
<hmtl>
	<head> 
		<meta name="eduki-mota" content="text/html;" http-equiv="content-type" charset="utf-8">
		<title>Add Question with Image PHP</title>
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
        <div id='page-wrap'>
			<header class='main' id='h1'>
				<h2>Add Question</h2>
			</header>


			<section class="main" id="s1">

            </section>
            
			<section class="main" id="s2">
          </section>
            
            <?php
                include 'config.php';
                
                $esteka = new mysqli($server, $user, $passwd, $database);
                if($esteka->connect_errno)
                {
                    die("Connection failed: " . $esteka->connect_error);
                }
                
                if (isset($_POST))
                {
                    $ePosta = $_GET["eposta"];
                    $eZuzena = ($_POST['eZuzena']);
                    $gTestua = ($_POST['gTestua']);
                    $eOkerra1 = ($_POST['eOkerra1']);
                    $eOkerra2 = ($_POST['eOkerra2']);
                    $eOkerra3 = ($_POST['eOkerra3']);
                    $gZail = ($_POST['gZail']);
                    $gArloa = ($_POST['gArloa']);
                    $Irudia = is_uploaded_file($_FILES["irudia"]["tmp_name"]);
                    
                    if(!empty($_FILES['irudia']['tmp_name']) && file_exists($_FILES['irudia']['tmp_name']))
                    {
                        $Irudia= addslashes(file_get_contents($_FILES['irudia']['tmp_name']));
                    }
                    
                    $trimePosta = trim($ePosta);
                    $trimgTestua = trim($gTestua);
                    $trimeZuzena = trim($eZuzena);
                    $trimeOkerra1 = trim($eOkerra1);
                    $trimeOkerra2 = trim($eOkerra2);
                    $trimeOkerra3 = trim($eOkerra3);
                    $trimgZail = trim($gZail);
                    $trimgArloa = trim($gArloa);
                    
                    preg_match('/^[a-zA-Z]{2,20}[0-9][0-9][0-9]@ikasle\.ehu\.eus$/', $trimePosta, $matchesePosta);
                    preg_match('^.{10}^', $trimgTestua, $matchesgTestua);
                    preg_match('/^.+$/', $trimeZuzena, $matcheseZuzena);
                    preg_match('/^.+$/', $trimeOkerra1, $matcheseOkerra1);
                    preg_match('/^.+$/', $trimeOkerra2, $matcheseOkerra2);
                    preg_match('/^.+$/', $trimeOkerra3, $matcheseOkerra3);
                    preg_match('/^.+$/', $trimgZail, $matchesgZail);
                    preg_match('/^.+$/', $trimgArloa, $matchesgArloa);
                    
                    if ($matchesePosta && $matchesgTestua && $matcheseZuzena && $matcheseOkerra1 && $matcheseOkerra2 && $matcheseOkerra3 && $matchesgZail && $matchesgArloa && strlen($trimgTestua)>9)
                    {
                        
                        $sql_Quiz = "INSERT INTO Questions(eposta, Galdera, ErantzunaZuzena, ErantzunOkerra1, ErantzunOkerra2, ErantzunOkerra3, Zailtasuna, Arloa, Irudia) VALUES ('$ePosta', '$gTestua', '$eZuzena', '$eOkerra1', '$eOkerra2', '$eOkerra3', '$gZail', '$gArloa', '$Irudia')";
                        
                        
                        if (mysqli_query($esteka,$sql_Quiz))
                        {
                            echo ("Galdera berria gorde da!\n");
                            echo nl2br ("\n\n");
                            echo nl2br ("<a href = showQuestionsWithImage.php?eposta=$ePosta >Ikusi dauden galdera guztiak.</a>\n");
                            echo nl2br ("<a href = addQuestion.php?eposta=$ePosta >Beste galdera bat egiteko.</a>\n");
                            echo nl2br ("<a href = layout.php?eposta=$ePosta >Hasierako orrira itzuli.</a>\n");
                            
                        }
                        else
                        {
                            echo "Error: " . $sql . "<br>" . $esteka->error;
                        }
                        
                        mysqli_close($esteka);
                    }
                }
                
            ?>

            </div>
            <center>
                <a href='layout.php?eposta=<?php $ePosta=$_GET["eposta"]; echo $ePosta;?>'>
                <img src="../images/atzera.png" align="middle" alt="" width="162" height="62" border="0"><br></a>
	           </center> 
			<footer class='main' id='f1'>
				 <a href='https://github.com/pruiz026/ws2018' target="_blank">Link GITHUB</a> | 
				<a href='layout.php?eposta=<?php $ePosta=$_GET["eposta"]; echo $ePosta;?>'>Home</a></span> 
			</footer>

	</body>
</html>
