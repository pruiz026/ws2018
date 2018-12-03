function eEzabatu()
		{
			var erabiltzailea =  $('input[name="erabiltzailea"]');
			var data = 'erabiltzailea=' + erabiltzailea.val();
			$.ajax({
				type: "POST",
				cache: false,
				url: "erabiltzaileaEzbatu.php",
				data: data,
				dataType: "html",
				error: function(ts){alert(ts.responseText)},
				success: function(response)
				{
					$("#mezuaAJAX").html(response);
				}
			})
		};	