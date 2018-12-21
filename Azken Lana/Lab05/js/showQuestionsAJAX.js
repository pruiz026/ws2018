function galderakIkusi() 
{	
	var xhro;

	if (window.XMLHttpRequest) xhro = new XMLHttpRequest();
	else xhro = new ActiveXObject("Microsoft.XMLHTTP");

	xhro.onreadystatechange = function() 
	{
		if (xhro.readyState == 4 && xhro.status == 200) 
		{
			var erantzuna = xhro.responseXML;
			var table = "<table border='1'><tr><th align='center'>Egilea</th><th align='center'>Enuntziatua</th><th align='center'>Erantzun zuzena</th></tr>";
			var xx = erantzuna.getElementsByTagName("assessmentItem");
			var loggedEmail = document.getElementById("loggedEmail").innerText;
			var height = 500;
			var view = false;

			var irudia = $("#fitxategia").val();
			var xheight = 0;
			if(irudia != "") xheight = 120;

			var galderaGuztiak = xx.length;
			var nireGalderak = 0;

			for (var i=0; i < xx.length; i++) 
			{
				if (xx[i].getAttribute("author") == loggedEmail ) 
				{
					if (!view)
					{
						view = true;	
					} 
					table +="<tr>" + "<td align='center'>" + xx[i].getAttribute("author") + "</td>" + "<td align='center'>" + xx[i].getElementsByTagName("itemBody")[0].getElementsByTagName("p")[0].childNodes[0].nodeValue + "</td>" + "<td align='center'>" + xx[i].getElementsByTagName("correctResponse")[0].getElementsByTagName("value")[0].childNodes[0].nodeValue + "</td>" + "</tr>";
					height += 20;

					nireGalderak++;
				}
			}
			table+="</table>";

			if (view)
			{
				document.getElementById("n1").style.height = height +"px";
				document.getElementById("s1").style.height = height +"px";
				document.getElementById("AJAXgalderak").innerHTML += "Nire galderak / Galdera guztiak DB: " + nireGalderak + " / " + galderaGuztiak;	
				document.getElementById("AJAXtaula").innerHTML = table;

			}
			else 
			{
				document.getElementById("n1").style.height = "400px";
				document.getElementById("s1").style.height = "400px";
				document.getElementById("AJAX").innerHTML = "Zure datu basea hutsik dago";
			}
		}
	};
	xhro.open('GET', '../xml/questions.xml?q='+new Date().getTime(), true);
	xhro.send();
}