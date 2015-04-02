<?php

	// oletussivu, ladataan jos sivua ei ole erikseen määritelty
	define("DEFAULT_PAGE", "frontpage");

	class pageHandler
	{
		// valittuna oleva sivu
		private $selectedFile;
		private $selectedPage;
		
		// palauttaa valittua sivua vastaavan tiedoston
		private function setPage($page)
		{			
			switch($page)
			{
				default: // Käytetään etusivua defaulttina, 404 sivu pitää vielä lisätä
				case 'frontpage':	$selected = 'frontpage.php';	break;
				case 'about':		$selected = 'about.php'; 		break;
				case 'purchase':	$selected = 'purchase.php';		break;
				case 'sales': 		$selected = 'sales.php';		break;
				case 'contact':		$selected = 'contact.php';		break;
			}
			
			return $selected;
		}
		
		// palauttaa valittuna olevan sivun varsinaisen tiedostonimen
		function Get()
		{
			return $this->selectedFile;
		}
		
		// palauttaa valittuna olevan sivun 'nimen'
		function GetName()
		{
			return $this->selectedPage;
		}
		
		// asettaa käyttäjän määrittelemän sivun
		function Set($page)
		{
			$this->selectedFile = $this->setPage($page);
			$this->selectedPage = $page;
		}

		// Konstruktori hakee globaalista GET muuttujasta valitun sivun
		function pageHandler($selector)
		{	
			if(isset($_GET[$selector]))
			{
				$this->selectedPage = $_GET[$selector];
            }
			else
			{
				$this->selectedPage = DEFAULT_PAGE;
			}
			$this->selectedFile = $this->setPage($this->selectedPage);
		}
	}

?>