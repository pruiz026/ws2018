<?php
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	require_once('lib/nusoap.php');
	require_once('lib/class.wsdlcache.php');

	//LOKALERAKO
	$ns="http://127.0.0.1//ws18/Lab06/php/egiaztatuPasahitza.php?wsdl";	
	//HODEIRAKO
	//$ns="https://wspruiz026.000webhostapp.com/Lab06/php/egiaztatuPasahitza.php?wsdl";
	
	$server = new soap_server;
	$server->configureWSDL('egiaztatuP',$ns);
	$server->wsdl->schemaTargetNamespace =$ns;
	$server->register('egiaztatuP', array('x'=>'xsd:string','y'=>'xsd:int'),array('z'=>'xsd:string'),$ns);


	function egiaztatuP($x, $y)
	{		
		if($y==1010)
		{
			$file = fopen("toppasswords.txt","r") or die("Pasahitza ez da aurkitu.");
			while(($pasahitza = fgets($file)) !== false)
			{
				$pasahitza = preg_replace('/\n+/','',trim($pasahitza));
				if(strcmp($x,$pasahitza)===0)
					return "BALIOGABEA";
			}
			return "BALIOZKOA";
		}
		else
		{
			return "ZERBITZURIK GABE";
		}
	}
		
	if(!isset($HTTP_RAW_POST_DATA))
	{
		$HTTP_RAW_POST_DATA = file_get_contents('php://input');
	}
	$server->service($HTTP_RAW_POST_DATA);
?>