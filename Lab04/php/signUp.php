

<!DOCTYPE html>
<html>
	<head>
		<meta name="eduki-mota" content="text/html;" http-equiv="content-type" charset="utf-8">
		<title>Sign Up </title>
	    <link rel='stylesheet' type='text/css' href='../styles/style.css' />
        <link rel='stylesheet' 
                   type='text/css' 
                   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
                   href='../styles/wide.css' />
        <link rel='stylesheet' 
                   type='text/css' 
                   media='only screen and (max-width: 480px)'
                   href='../styles/smartphone.css' />

	    <style>

	    	h1
	    	{
                text-align: center;

	    	}

		    label
            {
                font-style: italic;

            }

           
	    </style>
	</head>


	<body>

		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>

		<script>
			function previewFile() 
			{
		        var preview = document.querySelector('img');
		        var file = document.querySelector('input[type=file]').files[0];
		        var reader = new FileReader();
		        reader.onloadend = function () 
		        {
		            preview.src = reader.result;
        		}
        		if (file) 
        		{
            		reader.readAsDataURL(file);
       			} 
       			else 
       			{
            		preview.src = "";
        		}
				$("#igotakoirudia").show();
    		}

			function ezabatuigotakoirudia() 
			{
				$("#igotakoirudia").hide();
			}

			function egiaztatu()
			{
		
				if ($.betetadagoen()) 
				{
					var trimEposta= $("#eposta").val().trim();
					var trimDeitura= $("#deitura").val().trim();
	                if(	!trimEposta.match(/^[a-zA-Z]{2,20}[0-9][0-9][0-9]@ikasle\.ehu\.eus$/))
	                {
						alert("Posta ez du egitura egokia");
						return false;
					}
					if(!trimDeitura.match(/^([A-Z]([a-z]+)\s[A-Z]([a-z]+)\s?)+/))
					{
						alert("Deitura ez da zuzena.");
						return false;
					}
					if(!$("#pasahitza").val().match(/^\S{8,500}/))
					{
						alert("Pasahitzak gutxienez 8 karaktere izan behar ditu");
						return false;
					}
					if ($("#pasahitza").val() != $("#pasahitza2").val())
					{
						alert("Pasahitzak ez dira berdinak.");
						return false;
					}
					return true;
	            } 
	            else 
	            {
	                alert("Datu guztiak bete behar dira.");
	                return false;
	            }
				return true;
			}

		    $(document).ready(function()
		    {
		        $.betetadagoen = function()
		        {		
					if (($("#eposta").val().length>0 ) &&($("#deitura").val().length>0 ) &&($("#pasahitza").val().length>0 )&&($("#pasahitza2").val().length>0))
					{
		                return true;
		            } 
		            else 
		            {
		                return false;
		            }
		        }
		        $.postazuzena = function()
		        {
		            var balioa= $("#eposta").val();
		            if (balioa.match((/^[a-zA-Z]{2,20}[0-9][0-9][0-9]@ikasle\.ehu\.eus$/)))
		            {
		                return true;
		            } 
		            else 
		            {
		                return false;
		            }
		        }   
		       
		    })


		</script>


		<?php 

			if (isset($_POST['pasahitza'])) 
			{
				include 'config.php';

				$esteka = mysqli_connect($server, $user, $passwd, $database);
				if ($esteka->connect_error) 
				{
				    die("Errorea konektatzerakoan: " . $esteka->connect_error);
				}
				
				function phpAlert($msg) 
				{
					echo '<script type="text/javascript">alert("' . $msg . '")</script>';
				}

				$ePosta = $_POST['eposta'];
				$deitura = $_POST['deitura'];
				$pasahitza = $_POST['pasahitza'];
				$profila = is_uploaded_file($_FILES["irudiProfil"]["tmp_name"]);

				if ($profila !== false)
				{
					$image = $_FILES['irudiProfil']['tmp_name'];
					$imgContent = addslashes(file_get_contents($image));
				} 

				$trimEposta = trim($ePosta);
				$trimDeitura = trim($deitura);
				$trimPasahitza = trim($pasahitza);
				
				$sql_Quiz = "INSERT INTO erabiltzaileak (Eposta, Deitura, Pasahitza, IrudiProfil)
						VALUES ('$trimEposta', '$trimDeitura', '$trimPasahitza','$imgContent')";

				$insert = $esteka->query($sql_Quiz);
				if ($insert) 
				{
					phpAlert ("Erabiltzaile berria sortu da!");
				} 
				else 
				{
					phpAlert( "Posta elektroniko existitzen da, beste posta kontu bat sartu.");
				} 

				echo " Ongi etorri!, hemen sakatu hasierako orrira joateko";
                echo"<p><a href='layout.php'> Home </a>";
				mysqli_close($esteka);
			}
		?>
		


		<div id='page-wrap'>
            <header class='main' id='h1'>
            	<h2>Quiz: crazy questions</h2>
                <h1>Sign Up</h1>
            </header>

            <nav class='main' id='n1' role='navigation'>
                <span><a href='../layout.html'>Home</a></span>
                <span><a href='/quizzes'>Quizzes</a></span>
                <span><a href='../credits.html'>Credits</a></span>
            </nav>

            <section class="main" id="s1"><label>Bete formularioa:</label> 
				<form  id="signUp" name="signUp"  action="" method="post" onsubmit="return egiaztatu(this)" enctype="multipart/form-data" >
				   Posta elektronikoa(*): <input type="text" name="eposta" id="eposta" class="erantzuna" width="200" required pattern="^([a-z]{2,})([0-9]{3})@ikasle\.ehu\.eus$" value="xxxx000@ikasle.ehu.eus"/>
				    <br/>
				   Deitura(*): <input type="text" name="deitura"  class="erantzuna" id="deitura" height="2000px" required pattern="^([A-Z]{1}[a-z]+\s)([A-Z]{1}[a-z]+(\s)?)+$"/>
				    <br/>
				    Pasahitza(*): <input type="password" name="pasahitza" class="erantzuna" id="pasahitza" width="600px" required pattern="^.{8,}$"/>
				    <br/>
				    Pasahitza errepikatu(*): <input type="password" name="pasahitza2" class="erantzuna" id="pasahitza2" width="600px" required pattern="^.{8,}$"/>
					<br/><br/>
		            <label>Hautazkoa:</label> <br>
					<input type="file" name="irudiProfil" id="irudiProfil"  >
				    <br/><br/>

					<center>
					    <input type="submit" id="botoia" value="Sign Up" name="botoia" onsubmit="egiaztatu()" >
					    <input type="reset" value="Borratu" id="reset" onclick="ezabatuigotakoirudia()"><br><br>
					</center>
				</form>
			</section>
			<center>
				<br>
				<br/><br/>
				<footer class='main' id='f1'>
					 <a href='https://github.com/pruiz026/ws2018' target="_blank">Link GITHUB</a> | 
					 <a href='../layout.html'>Home</a>
				</footer>
			</center>
		</div>
	</body>
</html>

