<?php

    class DBHandler
    {
        // kahva tietokantayhteydelle
        private $DBH;

        private $ErrorLogFile;

        function GetImage($img_name, $language)
        {
            try
            {
                 // statement handle
                $STH = $this->DBH->prepare(
                    'SELECT img_path FROM site_imgs WHERE img_name = :img_name AND img_lang = :lang_id'
                );         

                // funktion parametreina olevien teksti-id:n ja kieli-id:n sidonta SQL-kyselyyn
                $STH->bindParam(':img_name', $img_name, PDO::PARAM_STR, 8);
                $STH->bindParam(':lang_id', $language, PDO::PARAM_STR, 8); 

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
                //file_put_contents('db/PDOErrors.txt', $e->getMessage(), FILE_APPEND);
            }
            
            return $row['img_path'];
        }

        
        function GetText($text_id, $language)
        {
            try
            {
                // statement handle
                $STH = $this->DBH->prepare(
                    'SELECT text FROM site_texts WHERE text_id = :text_id AND lang_id = :lang_id'
                );	

                // funktion parametreina olevien teksti-id:n ja kieli-id:n sidonta SQL-kyselyyn
                $STH->bindParam(':text_id', $text_id, PDO::PARAM_STR, 8);
                $STH->bindParam(':lang_id', $language, PDO::PARAM_STR, 8);

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
                //file_put_contents('db/PDOErrors.txt', $e->getMessage(), FILE_APPEND);
            }
            
            return $row['text'];
        }
        
        // Konstruktori
        function DBHandler($DBPath)
        {
            //echo "DBH ctor called";
            try
            {
                $dataSource = "sqlite:".$DBPath;
                $this->DBH = new PDO($dataSource);
                $this->DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            }
            // kirjaa PDO-virheet lokiin
            catch (PDOException $e)
            {
                die($e->getMessage());
                //file_put_contents('db/PDOErrors.txt', $e->getMessage(), FILE_APPEND);
            }
        }
        
        // Destruktori
        function __destruct()
        {
            // Yhteyden sulkeminen.
            // Tätä ei tarvitsisi edes välttämättä ekpslisiittisesti suorittaa.
            $this->DBH = null;
        }
    }
    
?>