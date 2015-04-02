<?php

	// tämä funktio hakee tekstejä tietokannasta teksti-id:n ja kieli-id:n perusteella perusteella
	function getTextFromDb($text_id, $language)
	{
		
		// käytetään globaalia tietokannan kahvaa
		global $DBH;

		try
		{
			// statement handle
			$STH = $DBH->prepare('SELECT text FROM site_texts WHERE text_id = :text_id AND lang_id = :lang_id');	

			// funktion parametreina olevien teksti-id:n ja kieli-id:n sidonta SQL-kyselyyn
			$STH->bindParam(':text_id', $text_id, PDO::PARAM_STR, 12);
			$STH->bindParam(':lang_id', $language, PDO::PARAM_STR, 12);

			// kyselyn ajaminen
			$STH->execute();		

			// assosiatiivinen fetch mode 
			$STH->setFetchMode(PDO::FETCH_ASSOC);

			// nappaa rivi tietokannasta...
			$row = $STH->fetch();
			
		}
		
		catch (PDOException $e)
		{
			echo $e->getMessage();
			file_put_contents('db/PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		}

		// ... ja palauta riviin kuuluva teksti
		return $row['text'];
	}	


	// Tämä skripti yhdistää SQLite3-tietokantaan

	// nappaa kiinni SQLite-tietokannasta käyttäen PHP Data Objectsia
	try
	{
		$DBH = new PDO("sqlite:db/text_db.db");
		$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	}

	// kirjaa PDO-virheet lokiin
	catch (PDOException $e)
	{
		echo $e->getMessage();
		file_put_contents('db/PDOErrors.txt', $e->getMessage(), FILE_APPEND);
	}

?>