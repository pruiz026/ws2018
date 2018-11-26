function galderakIkusi() 
{	
	var xhro = new XMLHttpRequest();
	xhro.onreadystatechange = function() 
	{
		if (xhro.readyState == 4 && xhro.status == 200) 
		{
			var erantzuna = xhro.responseXML;
			var table = "<table border='1'><tr><th align='center'>Egilea</th><th align='center'>Enuntziatua</th><th align='center'>Erantzun zuzena</th></tr>";
			var xx = erantzuna.getElementsByTagName("assessmentItem");
			var eposta = document.getElementById("loggedEmail").innerText;
			var height = 500;
			var view = false;

			
			for (var i=0; i < xx.length; i++) 
			{
				if (xx[i].getAttribute("author") == eposta ) 
				{
					if (!view)
					{
						view = true;	
					} 
					table +="<tr>" + "<td align='center'>" + xx[i].getAttribute("author") + "</td>" + "<td align='center'>" + xx[i].getElementsByTagName("itemBody")[0].getElementsByTagName("p")[0].childNodes[0].nodeValue + "</td>" + "<td align='center'>" + xx[i].getElementsByTagName("correctResponse")[0].getElementsByTagName("value")[0].childNodes[0].nodeValue + "</td>" + "</tr>";
					height += 20;

				}
			}
			table+="</table>";

			if (view)
			{
				document.getElementById("n1").style.height = height +"px";
				document.getElementById("s1").style.height = height +"px";
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
	xhro.open('GET', '../xml/questions.xml', true);
	xhro.send();
}