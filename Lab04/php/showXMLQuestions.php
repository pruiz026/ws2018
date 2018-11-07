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
    </head>

	<body>
    <div id='page-wrap'>
		<header class='main' id='h1'>

		</header>


        <nav class='main' id='n1' role='navigation'>  
			
		 </nav>
			<?php
				$xml=simplexml_load_file("../xml/questions.xml") or die("Error: Cannot create object");
			?>

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
				foreach($xml->children() as $assessmentItem)
				{
					echo "<tr>";
						echo "<td>" .$assessmentItem->attributes()->author."</td>";
						echo "<td>" .$assessmentItem->itemBody->p."</td>";
						echo "<td>" .$assessmentItem->correctResponse->value."</td>";
					echo "</tr>";
				}
				?>
				</tbody>
			</table>
			<section class="main" id="s1">
                    
            </section>
            
			<section class="main" id="s2">
				
            </section>
                   
            <center>
                <a href='layout.php?eposta=<?php $ePosta=$_GET["eposta"]; echo $ePosta;?>'>
                <img src="../images/atzera.png" align="middle" alt="" width="162" height="62" border="0"><br></a>
	           </center> 
			<footer class='main' id='f1'>
				 <a href='https://github.com/pruiz026/ws2018' target="_blank">Link GITHUB</a> | 
				<a href='layout.php?eposta=<?php $ePosta=$_GET["eposta"]; echo $ePosta;?>'>Home</a></span> 
			</footer>

	</body>
</html>