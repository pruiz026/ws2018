function egiaztatuPasahitza() 
{
	$pasahitza = document.getElementById('pasahitza').value;
	$data = ("pasahitza="+$pasahitza);

	$.ajax(
	{
		type: "POST",
		cache: false,
		url: "../php/egiaztatuPasahitza.php",
		data: $data,

		success: function(data)
		{
			$("#pasahitzaEgiaztatuta").fadeIn().html(data);
		}
	})
		
		
}