<!DOCTYPE HTML>
<hmtl>
    <head> 
        <meta name="eduki-mota" content="text/html;" http-equiv="content-type" charset="utf-8">
        <title>Add Question with Image PHP</title>
        <link rel='stylesheet' type='text/css' href='../styles/style.css' />
        <link rel='stylesheet' 
               type='text/css' 
               media='only screen and (min-width: 530px) and (min-device-width: 481px)'
               href='../styles/wide.css' />
        <link rel='stylesheet' 
               type='text/css' 
               media='only screen and (max-width: 480px)'
               href='../styles/smartphone.css' />

       	<script src="../js/jquery-3.2.1.js"></script>
       	<style>
       		#backButton
       		{
       			float: left;
       		}

       	</style>

    </head>

	<body>
    <div id='page-wrap'>
    	<header class='main' id='h1'>
			<span class="loginekoak"><a href="layout.php">LogOut</a> </span>
			<a id="backButton" href=javascript:history.go(-1);> <img src="../images/atrás.png" width="40" height="40"></a>
			<div id="logInfo"></div>
			<h2>Show XML Questions</h2>
		</header>

        <nav class='main' id='n1' role='navigation'> 
       		<span><a href='<?php $id=$_GET['logged']; echo "layout.php?logged=$id"; ?>'>Home</a></span>
			<span><a href='<?php $id=$_GET['logged']; echo "layout.php?logged=$id"; ?>'>Quizzes</a></span>			
			<span><a href='<?php $id=$_GET['logged']; echo "addQuestion.php?logged=$id"; ?>'>Add question</a></span>
			<span><a href='<?php $id=$_GET['logged']; echo "showQuestions.php?logged=$id"; ?>'>Show questions</a></span>
			<span class='logeatuak'><a href='<?php if (!empty($_GET['logged'])) {$id = $_GET['logged']; echo "../xml/questions.xml?logged=$id";} ?>'>XML Questions</a></span>
			<span><a href='<?php $id=$_GET['logged']; echo "credits.php?logged=$id"; ?>'>Credits</a></span>
			<span><a href='layout.php'>LogOut</a></li> 
		</nav>
			<table>
				<thead>
					<tr>
						<th>Egilea</th>
						<th>Enuntziatua</th>
						<th>Erantzun zuzena</th>
					</tr>
				</thead>
				<tbody>
				<?php
				
				include("userInfo.php");
				$xml= new SimpleXMLElement('../xml/questions.xml', null, true);

				foreach($xml->assessmentItem as $xml) 
				{
					echo "<tr>";
						echo "<td>" .$xml['author']."</td>";
						echo "<td>" .$xml->itemBody->p."</td>";
						echo "<td>" .$xml->correctResponse->value."</td>";
					echo "</tr>";
				}
				?>
				</tbody>
			</table>
			<section class="main" id="s1">
                    
            </section>
            
			<section class="main" id="s2">
				
            </section>
                   
            
			<footer class='main' id='f1'>
				 <a href='https://github.com/pruiz026/ws2018' target="_blank">Link GITHUB</a> 			
			</footer>

	</body>
</html>