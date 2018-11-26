<?php
	error_reporting(E_ERROR | E_WARNING | E_PARSE);

	require_once('lib/nusoap.php');
	require_once('lib/class.wsdlcache.php');

	$soapclient = new nusoap_client('http://ehusw.es/rosa/webZerbitzuak/egiaztatuMatrikula.php?wsdl', true);
	
	$emaitza = $soapclient->call('egiaztatuE',array('x'=>$_POST['eposta']));

	if ($emaitza == 'BAI')
	{
		echo "<script type='text/javascript'>document.getElementById('errregistratu').disabled = false;</script>";
		echo "<span style='color:green'><b>BAI</span>";
	}
	else
	{
		echo "<script type='text/javascript'>document.getElementById('errregistratu').disabled = true;</script>";
		echo "<span style='color:red'>EZ</span>";
	}	
?>