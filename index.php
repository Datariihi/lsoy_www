<?php
	// virheraportoinnin taso
	ini_set('display_errors', 1);
	error_reporting (E_ALL);

	require ('dbHandlerClass.php');
    $db = new DBHandler('db/text_db.db');

	require ('langSelector.php');
    $langSel = new langSelector();

    $pageLang = $langSel->Get();

	require ('pageHandler.php');
	$page = new pageHandler('site');
?>

<!DOCTYPE html>
<html lang="fi">

	<head>

		<meta charset="UTF-8">

		<!-- Internet Explorer käyttää tätä meta-tägiä määrittääksen missä yhteensopivuustilassa sivu tulisi renderöidä. Arvo "IE=edge" ottaa käyttöön uusimman saatavilla olevan tilan. Esim. IE9:llä otetaan käyttöön IE9-tila -->
	    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	    <meta name="viewport" content="width=device-width, initial-scale=1" />

		<title>Luopajärven Saha Oy</title>

		 <!-- Bootstrap -->
    	<link href="css/bootstrap.min.css" rel="stylesheet" />
    	<link href="assets/css/bootstrap-responsive.css" rel="stylesheet">

    	<!-- main.css ohittaa bootstrap.min.css:n -->
    	<link href="css/main.css" rel="stylesheet" />

	</head>

	<body>

		<!-- jQuery, Bootstrapin JavaScript-plugarit tarvitsevat tätä -->
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

	    <!-- Sisällytä kaikki valmiiksi käännetyt pluginit -->
	    <script src="js/bootstrap.min.js"></script>	

	    <div class="container">    		
			
            <?php

                require ('header.php');
                require ('navbar.php');
				require($page->Get()); 
				require ('footer.php');

				/*
                $site = 'frontpage';

                if (isset($_GET['site']))
                {
                	$site = $_GET['site'];
                }
                
                switch ($site)
                {
                	case 'frontpage':
                		require ('frontpage.php');
                		break;

                	case 'about':
                		require ('about.php');
                		break;

                	case 'purchase':
                		require ('purchase.php');
                		break;

                	case 'sales':
                		require ('sales.php');
                		break;

                	case 'contact':
                		require ('contact.php');
                		break;

                	default:
                		require ('404.php');
                		break;
                }

                require ('footer.php');
			
				*/
            ?>

	    </div> <!--container-->

	</body>

</html>

<?php $STH = null; $DBH = null; // sulkee tietokantayhteyden ?>