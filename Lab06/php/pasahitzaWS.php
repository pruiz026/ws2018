<?php
	error_reporting(E_ERROR | E_WARNING | E_PARSE);

	require_once('lib/nusoap.php');
	require_once('lib/class.wsdlcache.php');

	//LOKALERAKO
	$soapclient = new nusoap_client('http://127.0.0.1//ws18/Lab06/php//egiaztatuPasahitza.php?wsdl', true);
	//HODEIRAKO
	//$soapclient = new nusoap_client('https://wspruiz026.000webhostapp.com/Lab06/php/egiaztatuPasahitza.php?wsdl', true);

	$emaitza = $soapclient->call('egiaztatuP', array('x'=>$_POST['pasahitza'],'y'=>1010));
	
	if($emaitza=='BALIOZKOA')
	{
		echo "<script type='text/javascript'>document.getElementById('erregistratu').disabled = false;</script>";
		echo "<span style='color:green'><b>Baliozko pasahitza da</span>";
	}	
	elseif($emaitza=='BALIOGABEA')
	{
		echo "<script type='text/javascript'>document.getElementById('erregistratu').disabled = true;</script>";
		echo "<span style='color:red'>Pasahitza oso ahula da</span>";
	}
	else
	{
		echo "<script type='text/javascript'>document.getElementById('erregistratu').disabled = true;</script>";
		echo "<span style='color:red'>ZERBITZURIK GABE</span>";
	}
?>


