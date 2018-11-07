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

    
    	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    	<script src="js/jquery-3.2.1.js"></script>
    
	</head>

	<body>
        <div id='page-wrap'>
			<header class='main' id='h1'>

			</header>


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
                    
                    $ePosta = ($_POST['eposta']);
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
                    preg_match('/^.+$/', $trimgTestua, $matchesgTestua);
                    preg_match('/^.+$/', $trimeZuzena, $matcheseZuzena);
                    preg_match('/^.+$/', $trimeOkerra1, $matcheseOkerra1);
                    preg_match('/^.+$/', $trimeOkerra2, $matcheseOkerra2);
                    preg_match('/^.+$/', $trimeOkerra3, $matcheseOkerra3);
                    preg_match('/^.+$/', $trimgZail, $matchesgZail);
                    preg_match('/^.+$/', $trimgArloa, $matchesgArloa);
                    
                    if ($matchesePosta && $matchesgTestua && $matcheseZuzena && $matcheseOkerra1 && $matcheseOkerra2 && $matcheseOkerra3 && $matchesgZail && $matchesgArloa && strlen($trimgTestua)>9)
                    {
                        
                        $sql_Quiz = "INSERT INTO Questions(eposta, Galdera, ErantzunaZuzena, ErantzunOkerra1, ErantzunOkerra2, ErantzunOkerra3, Zailtasuna, Arloa, Irudia) VALUES ('$ePosta', '$gTestua', '$eZuzena', '$eOkerra1', '$eOkerra2', '$eOkerra3', '$gZail', '$gArloa', '$Irudia')";
                        $insert = $esteka->query($sql_Quiz);
                        $xml = simplexml_load_file('../xml/questions.xml');                      
                        if ($insert)
                        {
                            $assesmentItem = $xml->addChild('assessmentItem');
                            $assesmentItem->addAttribute('author', $ePosta);                            
                            $itemBody = $assesmentItem->addChild('itemBody');
                            $itemBody = $itemBody->addChild('p', $gTestua);
                            $correctResponse = $assesmentItem->addChild('correctResponse',$eZuzena);
                            
                            $xml->asXML ('../xml/questions.xml');
                            echo "<script>zuzena('XML fitxategia zuzen eguneratu da')</script>";

                            
                            echo nl2br ("Galdera berria gordeta!\n");
                            echo nl2br ("<a href = showQuestionsWithImage.php?eposta=$ePosta >Ikusi dauden galdera guztiak.</a>\n");
                            echo nl2br ("\n\n");
                            echo nl2br ("<a href = showXMLQuestions.php?eposta=$ePosta > Ikusi dauden galdera guztiak XML fitxategian. </a>\n");
                            echo nl2br ("\n\n");
                            echo nl2br ("<a href = addQuestion.php?eposta=$ePosta >Beste galdera bat egin.</a>\n");
                            echo nl2br ("<a href = layout.php?eposta=$ePosta >Hasierako orrira itzuli.</a>\n");
                            
                        }
                        else
                        {
                            echo "Error: " . $sql_Quiz . "<br>" . $esteka->error;
                            echo nl2br ("\n");
                            echo ("Errorea: galderak.xml-en ezin izan da galdera txertatu.\n");
                            echo ("<a href = addQuestion.php?eposta=$ePosta >Errorea egon da. Saiatu berriro galdera sartzen. Klikatu hemen.</a>");
                        }
                    }
                    else
                    {
                        echo nl2br ("Errorea! Sartutako zelai guztiak ez dira egoki bete.\n");
                        echo nl2br ("Zerbitzaria konturatu da akats horretaz. Kontuz, aldatu beharko duzu!\n");
                        echo nl2br ("<a href = addQuestion.php?eposta=$ePosta >Saiatu berriro galdera ezartzen.</a>\n");
                    }
                }
                else
                {
                    echo "Errorea: isset.";
                }
                ?>


			<section class="main" id="s1">
                    
            </section>
            
			<section class="main" id="s2">
				
            </section>
                   
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
