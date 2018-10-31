<!DOCTYPE html>
<html>
    <head>
        <meta name="eduki-mota" content="text/html;" http-equiv="content-type" charset="utf-8">
        <title>Log In </title>
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
            
            
            
        </style>
    </head>


<body>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>

    <script>

        $(document).ready(function()
        {

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

            $.biakBeteta = function()
            {       
                if ($("#eposta").val().length>0 && $.postazuzena())
                {
                    if ($("#pasahitza").val().length>6)
                    {
                        return true;
                    } 
                    else 
                    {
                        alert("Pasahitza ez da egokia.");
                        return false;
                    }
                } 
                else 
                {
                    alert("Posta ez da egokia.");
                    return false;
                }
            }
    		

            $("#logIn").submit(function()  
            {
                if ($.biakBeteta()) 
                {
                    if ($.postazuzena())
                    {
                        return true;
                    }
                    else
                    {
                        alert("Eposta okerra da");
                        return false;
                    }
    			} 
                else 
                {
                    alert("Hutsuneak daude, datu guztiak bete behar dira");
                    return false;
                }
            })
        })

        </script>

        <?php 

            if (isset($_POST['eposta'])) 
            {
                
                include 'config.php';

                $esteka = mysqli_connect($server, $user, $passwd, $database);
                if ($esteka->connect_error) 
                {
                    die("Errorea konektatzerakoan: " . $esteka->connect_error);
                }
                
                $ePosta = $_POST['eposta'];
                $pasahitza = $_POST['pasahitza'];
                
                $sql_Quiz = "SELECT * FROM erabiltzaileak WHERE Eposta='$ePosta' AND Pasahitza='$pasahitza'";

                $ema = $esteka-> query($sql_Quiz);

                if (! ($ema)) 
                {
                    echo "Errorea kontsultan<br >". $ema->error; 
                } 
                else 
                {
                    $rows_cnt = $ema->num_rows;
                    mysqli_close($esteka);
                    if ($rows_cnt==1) 
                    {
                        $rows_cnt=0;
                        header ('Location: layout.php?ePosta='.$ePosta.'');
                    } 
                    else  
                    {
                        echo "<script> alert('Pasahitza ez da zuzena. Saiatu berriro.') </script>";
                    }
                }
                
             }
        ?>
        
        <div id='page-wrap'>
            <header class='main' id='h1'>
                <h2>Quiz: crazy questions</h2>
                <h1>Log In</h1>
            </header>

            <nav class='main' id='n1' role='navigation'>
                <span><a href='../layout.html'>Home</a></span>
                <span><a href='/quizzes'>Quizzes</a></span>
                <span><a href='../credits.html'>Credits</a></span>
            </nav>

            <section class="main" id="s1">
                <form  id="logIn" name="logIn"  action="logIn.php" method="post"  enctype="multipart/form-data">
                    Posta elektronikoa (*): <input type="text" name="eposta" id="eposta" class="erantzuna"/>
                    <br/><br/>
                    Pasahitza (*): <input type="password" name="pasahitza"  class="erantzuna" id="deitura" height="2000px"/>
                    <br/><br/>
                	<input id="botoia" type="submit" value="Log In" name="botoia" width="350px" >
                </form>
                <br/><br/>
            </section>       

            <center>
                <br>
                <footer class='main' id='f1'>
                    <a href='signUp.php'>Kontu bat sortzeko, sakatu hemen.</a> | 
                    <a href='https://github.com/pruiz026/ws2018' target="_blank">Link GITHUB</a> | 
                    <a href='../layout.html'>Home</a>
                </footer>
            </center>
        </div>

    </body>

</html>
