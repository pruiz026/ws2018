function matrikulatutaEgiaztatu() 
{
	$eposta = document.getElementById('eposta').value;
	$data = ("eposta="+$eposta);
	
	$.ajax(
	{
		type: "POST",
		cache: false,
		url: "../php/matrikulatutaWS.php",
        data: $data,

		success: function(data)
		{
			$("#matrikulatutaEgiaztatuta").fadeIn().html(data);
		} 
	}
}


		