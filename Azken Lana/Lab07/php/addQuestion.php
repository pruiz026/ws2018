<?php
	header("Control-cache: no-store, no-cache, must-revalidate");
	session_start();
	include("userInfo.php");
	
	$galdera = preg_replace('/\s\s+/', ' ', trim($_POST['galdera']));
	$erantzunZuzena = $_POST['erantzunZuzena'];
	$erantzunOkerra1 = $_POST['erantzunOkerra1'];
	$erantzunOkerra2 = $_POST['erantzunOkerra2'];
	$erantzunOkerra3 = $_POST['erantzunOkerra3'];
	$zailtasuna = $_POST['zailtasuna'];
	$arloa = $_POST['arloa'];
	$irudiTamaina = $_FILES['fitxategia']['size'];
	if($irudiTamaina > 0) 
	{
		$irudiIzena = $_FILES['fitxategia']['name'];
		$irudiTmp = $_FILES['fitxategia']['tmp_name'];
		$irudia = addslashes(file_get_contents($_FILES['fitxategia']['tmp_name']));
	}
				
	include("dbConfig.php");
	$linki= mysqli_connect($server, $user, $passwd, $database);
	if(!$linki) echo '<script> alert("Konexio errorea"); </script>';
	else 
	{
		$linki->query("INSERT INTO questions(eposta, galderaTestua, erantzunZuzena, erantzunOkerra1, erantzunOkerra2, erantzunOkerra3, zailtasuna, arloa, irudia) 
		VALUES ('$eposta', '$galdera', '$erantzunZuzena', '$erantzunOkerra1', '$erantzunOkerra2', '$erantzunOkerra3', '$zailtasuna', '$arloa', '$irudia')");
		
		echo '<script> alert("Zure galdera datu basera gehitu da"); </script>';
        
        //////XML///////
        $file='../xml/questions.xml';
		$xml= simplexml_load_file($file);
		
		$assessmentItem=$xml->addChild("assessmentItem");
		
		$assessmentItem->addAttribute('author',$eposta);
		$assessmentItem->addAttribute('subject',$arloa);
		
		$itemBody=$assessmentItem->addChild('itemBody');
		$itemBody->addChild('p',$galdera);
		
		$correctResponse=$assessmentItem->addChild('correctResponse');
		$correctResponse->addChild('value',$erantzunZuzena);
		
		$incorrectResponses=$assessmentItem->addChild('incorrectResponses');
		$incorrectResponses->addChild('value',$erantzunOkerra1);
		$incorrectResponses->addChild('value',$erantzunOkerra2);
		$incorrectResponses->addChild('value',$erantzunOkerra3);
		
		$xml->asXML($file);
						
	}
	

?>






