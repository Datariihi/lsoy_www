<?php

    // oletuskieli
    define("DEFAULT_LANGUAGE", "FI");

    class langSelector
    {
        // luokan sisäinen muuttuja kielivalinnalle
        private $LANG;
        
        // taulukko tietokannassa saatavilla olevista kielistä
        private $dbLanguages;
        
        // asettaa kielen $LANG muuttujaan jos kielen ID löytyy tietokantataulukosta
        private function setLanguage($langID)
        {
            $langID = strtolower($langID);

            // asetetaan kieli jos löytyy taulukosta
            if(isset($this->dbLanguages[$langID]))         
               return $this->dbLanguages[$langID];

            // jos kieltä ei löydy taulukosta niin palautetaan nykyinen kieli
            return DEFAULT_LANGUAGE;
        }
        
        // palauttaa valitun kielen
        function Get()
        {
            return $this->LANG;
        }
        
        // aseta kieli manuaalisesti
        function Set($langID)
        {
            $this->LANG = $this->setLanguage($langID);
        }
        
        // konstruktori
        function langSelector()
        {
            // taulukko saatavilla olevista kielistä
            $this->dbLanguages = array (
                "fi" => "FI",
                "en" => "EN"
            );
            
            if(isset($_GET["lang"]))
            {
                $this->LANG = $this->setLanguage($_GET["lang"]);
                
                // 86400 = 1 päivä
                setcookie("lang", $this->LANG, time() + (86400 * 30), "/");
            }
            // muuten jos keksi on asetettu, haetaan kieli kekseistä
            else if(isset($_COOKIE["lang"]))
            {  
                $this->LANG = $this->setLanguage($_COOKIE["lang"]);
            }
            // aseta oletuskieli
            else $this->LANG = DEFAULT_LANGUAGE;
        }
    }

?>