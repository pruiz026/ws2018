<?php 
    $ePosta=$_GET["eposta"];
?> 

<!DOCTYPE HTML>
<html>
  <head>
        <meta name="eduki-mota" content="text/html;" http-equiv="content-type" charset="utf-8">
        <title>Add Question PHP</title>
        <link rel='stylesheet' type='text/css' href='../styles/style.css' />
        <link rel='stylesheet' 
	           type='text/css' 
	           media='only screen and (min-width: 530px) and (min-device-width: 481px)'
	           href='../styles/wide.css' />
        <link rel='stylesheet' 
               type='text/css' 
               media='only screen and (max-width: 480px)'
               href='../styles/smartphone.css' />
    
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <style>

            label
            {
                font-style: italic;

            }
    </style>
   </head>

   <body>	

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


            $(document).ready(function()
            {
                $.betetadagoen = function()
                {
                    if (($("#eposta").val().length>0) &&($("#gTestua").val().length>0 )&&($("#eZuzena").val().length>0 )&&($("#eOkerra1").val().length>0 )
                        &&($("#eOkerra2").val().length>0 )&($("#eOkerra3").val().length>0 )&($("#gZail").val().length>0 ) &($("#gArloa").val().length>0))
                    {
                        return true;
                    } 
                    else 
                    {
                        return false;
                    }
                }

                $.epostakonprobatu = function()
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
                

                $('#galderenF').submit(function() 
                 {
                    if ($.betetadagoen()) 
                    {
                        if ($.epostakonprobatu()) 
                        {
                            if ($("#gTestua").val().length>=10)
                            {
                                return true;
                            } 
                            else 
                            {
                                alert("Galderak gutxienez 10 karakterekoa izan behar ditu");
                                return false;
                            }         
                        } 
                        else
                        {
                            alert("Eposta elektronikoa okerra da");
                            return false;
                        }
                    } else 
                    {
                        alert("Hutsuneak daude, datu guztiak bete behar dira");
                        return false;
                    }
                })
            })

        </script>  



		<div id='page-wrap'>
			<header class='main' id='h1'>
				<h2>Add Question</h2>
			</header>


            <nav class='main' id='n1' role='navigation'>
            <?php 


                include 'config.php';

                if($_SERVER['REQUEST_METHOD']=='POST')
                {
                    $ePosta = ($_POST['eposta']);
                    $eZuzena = ($_POST['eZuzena']);
                    $gTestua = ($_POST['gTestua']);
                    $eOkerra1 = ($_POST['eOkerra1']);
                    $eOkerra2 = ($_POST['eOkerra2']);
                    $eOkerra3 = ($_POST['eOkerra3']);
                    $gZail = ($_POST['gZail']);
                    $gArloa = ($_POST['gArloa']);

                    $esteka = mysqli_connect($server, $user, $passwd, $database);
                    if ($esteka->connect_error) 
                    {
                        die("Errorea konektatzerakoan: " . $esteka->connect_error);
                    }

                    $sq_Quizl = "INSERT INTO Questions (eposta, Galdera, ErantzunaZuzena, ErantzunOkerra1, ErantzunOkerra2, ErantzunOkerra3, Zailtasuna, Arloa)
                    VALUES ('$ePosta', '$gTestua', '$eZuzena', '$eOkerra1', '$eOkerra2', '$eOkerra3', '$gZail', '$gArloa')";


                    if (mysqli_query($esteka,$sql_Quiz))
                    {
                        echo ("Galdera berria gorde da!\n");
                        echo ("<a href = showQuestions.php >Ikusi dauden galdera guztiak.</a><br />");  
                    }
                    else 
                    {
                        echo "Error: " . $sql . "<br>" . $esteka->error;
                        echo ("<a href = ../addQuestion.html > Errorea, saiatu berriro hemen sakatuz.</a><br />");  
                    }

                    mysqli_close($esteka);

                }


            ?>
            </nav>


			<section class="main" id="s1">
                <div>
                    <form  id="galderenF" name="galderenF"  action="addQuestion.php?eposta=<?php $ePosta=$_GET["eposta"]; echo $ePosta;?>" method="post">
                        <label>Bezeroaren informazioa:</label><br>
                        <span>Posta elektronikoa(*):<input type="text" name="eposta" id="eposta" /></span><br/><br>

                        <label>Galderaren informazioa:</label> <br>
                        <span>Galderaren testua(*):<input type="text" name="gTestua"  class="erantzuna" id="gTestua" height="2000px"/></span><br/><br>
                        <span>Erantzun zuzena(*):<input type="text" name="eZuzena" class="erantzuna" id="eZuzena" width="600px"/></span><br/><br>
                        <span>Erantzun okerra1(*):<input type="text" name="eOkerra1" class="erantzuna" id="eOkerra1" width="600px"/> </span><br/><br>
                        <span>Erantzun okerra2(*):<input type="text" name="eOkerra2" class="erantzuna" id="eOkerra2" width="600px"/> <span><br/><br>
                        <span> Erantzun okerra3(*):<input type="text" name="eOkerra3" class="erantzuna" id="eOkerra3" width="600px"/> </span><br/><br>
                        <span> Galderaren zailtasuna(0-5)(*): 
                        <select id="gZail" name="gZail">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select></span><br/><br>
                        <span>Galderaren arloa(*):<input type="text" name="gArloa" id="gArloa"/> </span>
                        <br/><br>
                        <label>Hautazkoa:</label> <br>
                        Irudia:<input type="file" name="irudia" id="irudia" accept="image/*" onchange="previewFile();"/>
                        <br/>
                         <img src="" id="igotakoirudia" height="200" width="200" style="display: none;">
                        <br/><br/>
                        <input id="botoia" type="submit" value="Bidali"/>
                        <input type="reset" value="Borratu" id="reset" onclick = "ezabatuigotakoirudia();"/><br><br>
                    </form>
                </div>
			
            <center>
                <a href='layout.php?eposta=<?php $ePosta=$_GET["eposta"]; echo $ePosta;?>'>
                <img src="../images/atzera.png" align="middle" alt="" width="162" height="62" border="0"><br></a>
            </center> 
            <footer class='main' id='f1'>
				 <a href='https://github.com/pruiz026/ws2018' target="_blank">Link GITHUB</a> | 
                 <a href='layout.php?eposta=<?php $ePosta=$_GET["eposta"]; echo $ePosta;?>'>Home</a>
			</footer>
            
		</div>
    </section>
	</body>
</html>
