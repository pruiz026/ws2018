$(document).ready(function()
{
	$("#txertatu").click(function()
	{
		
		var galdera = $("#galdera").val().trim(galdera).replace(/\s+/g, " ");
		var erantzunZuzena = $("#erantzunZuzena").val();				
		var erantzunOkerra1 = $("#erantzunOkerra1").val();
		var erantzunOkerra2 = $("#erantzunOkerra2").val();				
		var erantzunOkerra3 = $("#erantzunOkerra3").val();
		var zailtasuna = $("#zailtasuna").val();				
		var arloa = $("#arloa").val();
		var irudia = $("#fitxategia").val();
		var erroreak = "";
		if(galdera == "") erroreak += "(*) Galdera ez dago ondo osatuta\n";
		else if(galdera.length < 10) erroreak += "(*) Galderaren luzera 10ko izan behar du gutxienez\n";
		if(erantzunZuzena == "") erroreak += "(*) Erantzun zuzena bete gabe\n";
		if(erantzunOkerra1 == "") erroreak += "(*) Erantzun okerra1 bete gabe\n";
		if(erantzunOkerra2 == "") erroreak += "(*) Erantzun okerra2 bete gabe\n";
		if(erantzunOkerra3 == "") erroreak += "(*) Erantzun okerra3 bete gabe\n";
		if(arloa == "") erroreak += "(*) Gai-arloa zehaztu gabe dago\n";
		
		if(irudia !== "" && irudia.match(".jpg") == null && irudia.match(".jpeg") == null && irudia.match(".png") == null &&
		irudia !== "" && irudia.match(".JPG") == null && irudia.match(".JPEG") == null && irudia.match(".PNG") == null) 
		{
			erroreak += '(hautazkoa) Irudiaren formatua okerra, irudiak ".jpg", ".jpeg", ".png", ".JPG", ".JPEG" edo ".PNG" luzapena eduki behar du\n';
		}
		
		if(erroreak !== "") alert(erroreak);
		else 
		{
			var request_method = $("#formularioa").attr("method");
			var form_data = $("#formularioa").serialize();

			$.ajax(
			{
				async: true,
				type: request_method,
				url: "../php/addQuestion.php",
				cache : false,
				data:form_data,
				success:function()
				{
					$("#AJAX").html("<br>Zure galdera datu basera gehitu da<br>");
					galderakIkusi(true);

				}

			}
			); 
			return false;
		}
	});
});