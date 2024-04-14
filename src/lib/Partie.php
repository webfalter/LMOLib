<?php
/**
 * LMOLib
 *
 * Partie, die in einer Liga gespielt wird
 *
 * @author Tim Schumacher
 * @author Rene Marth
 * @author Markus Doerfling
 * @author Marcus Schug
 * @author Torsten Hofmann
 *
 * @package LMOLib
 * @version 5.0.1
 *
 */
declare(strict_types=1);

namespace LMOLib\lib;

class Partie
{
    /**
     * Nummer der Partie,
     * @var integer
     */
    public $spNr;
    /**
     * Datum der Partie,
     * @var integer date
     */
      public $zeit;
    /**
     * Absage zur Partie,
     * @var integer
     */
      public $absage;
    /**
     * Notiz der Partie,
     * @var string
     */
      public $notiz;
    /**
     * Heimmannschaft der Partie,
     * @var array Team Objekt
     */
      public $heim;
    /**
     * Gastmannschaft der Partie,
     * @var array Team Objekt
     */
      public $gast;
    /**
     * Heimtore der Partie,
     * @var integer
     */
      public $hTore;
    /**
     * Gasttore der Partie,
     * @var integer
     */
      public $gTore;
    /**
     * Heimpkte der Partie,
     * @var integer
     */
      public $hPunkte;
    /**
     * Gastpkte der Partie,
     * @var integer
     */
      public $gPunkte;
    /**
     * URL zum Spielbericht der Partie
     * @var string
     */
      public $reportUrl= null;
    /**
     * Spielende
     * 0 = regul‰res Ende
     * 2 = Verl‰ngerung
     * 1 = 11-Meter-Schieﬂen
     * @since 2.2
     * @var integer
     */
      public $spielEnde= 0;
    /**
     *
     * @since 3.5
     * @var integer
     */
      public $tliga;
    /**
     * Other Parameter - Alle anderen Parameter die nicht direkt zugeordnet werden
     *
     * @var array
     */
      public $otherParameter = array();
    /**
     * Konstruktur
     *
     * @param  integer $spNr
     * @param  string  $time
     * @param  integer $absage
     * @param  string  $notiz
     * @param  array   $heim
     * @param  array   $gast
     * @param  integer $hTore
     * @param  integer $gTore
     * @param  integer $hPunkte
     * @param  integer $gPunkte
     */
    public function __construct($spNr,$time,$absage,$notiz,&$heim,&$gast,
                              $hTore,$gTore,$hPunkte=0,$gPunkte=0)
    {
        $this->spNr = (int)$spNr;
        $this->zeit = (int)$time;
        $this->absage = (int)$absage;
        $this->notiz = (string)$notiz;
        $this->heim = (object)$heim;
        $this->gast = (object)$gast;
        $this->hTore = (int)$hTore;
        $this->gTore = (int)$gTore;
        $this->hPunkte = (int)$hPunkte;
        $this->gPunkte = (int)$gPunkte;
    }
    /**
     * Gibt Tore der Heimmanschaft f¸r die Bildschirmausgabe zur¸ck.
     *
     * Die Ausgabe von negativen Werten wird zur Bildschirmausgabe unterdr¸ckt.
     * So werden negative Ergebnisse bzw Ergebnisse von Partien die noch nicht
     * stattfanden durch den Parameterwert f¸r $leer angezeigt.
     *
     * @param  string $leer Der R¸ckgabewert wenn Ergebnis vorhanden ist
     * @return string
     */
    public function hToreString($leer="_")
    {
        if ($this->hTore == -1)
            $str = $leer;
        elseif ($this->hTore == -2)
            $str = "0*"; // Markieren als greenTable
        elseif ($this->gTore == -2)
            $str = "0"; // Wenn Gast der Sieg zugesprochen wurde O Tore f¸r Heim anzeigen
        else
            $str = $this->hTore;
        return $str;
    }
    /**
     * Gibt Tore der Gastmannschaft f¸r die Bildschirmausgabe zur¸ck.
     * Die Ausgabe von negativen Werten wird zur Bildschirmausgabe unterdr¸ckt.
     * So werden negative Ergebnisse bzw Ergebnisse von Partien die noch nicht
     * stattfanden durch den Parameterwert f¸r $leer angezeigt.
     *
     * @param  string $leer Der R¸ckgabewert wenn kein Ergebnis vorhanden ist
     * @return string
     */
    public function gToreString($leer = "_")
    {
        if ($this->gTore == -1)
            $str = $leer;
        elseif ($this->gTore == -2)
            $str = "0*"; // Markieren als greenTable
        elseif ($this->hTore == -2)
            $str = "0"; // Wenn Heim der Sieg zugesprochen wurde O Tore f¸r Gast anzeigen
        else
            $str = $this->gTore;
        return $str;
    }
    /**
     * Gibt Gewonnen Saetze der Heimmannschaft f¸r die Bildschirmausgabe zur¸ck.
     *
     * Die Ausgabe von negativen Werten wird zur Bildschirmausgabe unterdr¸ckt.
     * So werden negative Ergebnisse bzw Ergebnisse von Partien die noch nicht
     * stattfanden durch den Parameterwert f¸r $leer angezeigt.
     *
     * @param  string $leer Der R¸ckgabewert wenn kein Ergebnis vorhanden ist
     * @return string
     */
    public function hSatzString($leer = "_")
    {
        $str = ($this->otherParameter['SA'] == -1)? $leer:$this->otherParameter['SA'];
        /*
        if($this->otherParameter['SA'] == -1)
          $str = $leer;
        else
         $str = $this->otherParameter['SA'];
        */
        return $str;
    }
    /**
      *
      *
      */
    public function gSatzString($leer = "_")
    {
        $str = ($this->otherParameter['SB'] == -1)? $leer:$this->otherParameter['SB'];
        /*
        if($this->otherParameter['SB'] == -1)
          $str = $leer;
        else
        $str = $this->otherParameter['SB'];
        */
        return $str;
    }
    /**
      *
      *
      */
    public function iSatzString($leer = "_")
    {
        if ($this->otherParameter['SC'] == -1)
            $str = $leer;
        else
            $str = $this->otherParameter['SC'];
        return $str;
    }
    /**
      *
      *
      */
    public function jSatzString($leer = "_")
    {
        if ($this->otherParameter['SD'] == -1)
            $str = $leer;
        else
            $str = $this->otherParameter['SD'];
        return $str;
    }
    /**
      *
      *
      */
    public function kSatzString($leer = "_")
    {
        if ($this->otherParameter['SE'] == -1)
            $str = $leer;
        else
            $str = $this->otherParameter['SE'];
        return $str;
    }
    /**
      *
      *
      */
    public function lSatzString($leer = "_")
    {
        if ($this->otherParameter['SF'] == -1)
            $str = $leer;
        else
            $str = $this->otherParameter['SF'];
        return $str;
    }
    /**
     * Ermittelt die Wertung der Partie
     *
     * Ergebnisswertung
     * -1: kein Ergebniss
     *  0: unentschieden
     *  1: Heim Sieg
     *  2: Gast Sieg
     *  3: Green Heim
     *  4: Green Gast
     *  5: Elfmeter
     *
     * @return integer
     */
    public function valuateGame()
    {
        $result = -1;
        if ($this->hTore > -1 && $this->gTore > -1 && isset($this->otherParameter['ET'])!=3) {
            if ($this->hTore > $this->gTore) {
                $result = 1;
            } elseif ($this->hTore < $this->gTore) {
                $result = 2;
            } else { // Unentschieden
                $result = 0;
            }
        } elseif ($this->hTore == -2) {
            $result = 3;
        } elseif ($this->gTore == -2) {
            $result = 4;
        } elseif (isset($this->otherParameter['ET'])== 3) {
            $result = 5;
        }
        return (int)$result;
    }
    /**
     *
     *
     */
    public function nextGame()
    {
          $result = '';
    //echo $spieltag->getModus();
    //print_r($this->getParameter());
          if($this->getParameter('TA')+$this->getParameter('TB') >
             $this->getParameter('GA')+$this->getParameter('GB')) {
          $result = 1;
        }
        return $result;
    }
    /**
     *
     * @deprecated
     * @return string
     */
    public function valuateCssGame()
    {
        $str='';
        if ($this->valuateGame()==1) {
          $str='#0C0';
        } elseif ($this->valuateGame()==2) {
          $str="#f00";
        } elseif ($this->valuateGame()==0) {
          $str='#0000FF';
        } else {
          $str='';
        }
        return $str;
    }
    /**
     * Gibt das SpielDatum als formatierten String zur¸ck. "%d.%m.%Y" = Standard
     *
     *
     * @param string leer Ausgabe, falls kein Datum vorhanden
     * @param string format Datumsformat in strftime()-Notation Standard = %d.%m.%Y
     * @return string
     */
    public function datumString($leer='',$format="%d.%m.%Y")
    {
        $str = ($this->zeit<1)?$leer:date($format,$this->zeit);
        //$str = ($this->zeit<1)?$leer:strftime($format,$this->zeit);
        return $str;
    }
    /**
     * Gibt die Anfangszeit als formatierten String zur¸ck "Stunden:Minuten" = Standard
     *
     * @param string leer Ausgabe, falls keine Zeit vorhanden
     * @param string format Zeitformat in strftime()-Notation Standard = %H:%M
     * @return string
     */
    public function zeitString($leer='',$format="%H:%M")
    {
    //$str = ($this->zeit<1)?$leer:strftime($format,$this->zeit);
        $str='';
        $res = ($this->zeit<1)?$leer:date($format,$this->zeit);
        if ($res!='00:00') {
            $str=$res;
        } else {
            $str=$res.'<abbr title="Datum steht noch nicht fest">*</abbr>';
        }
        return $str;
    }
    /**
     * Gibt f¸r eine Partie aus, ob Verl‰ngerung oder 11/7-Meterschieﬂen
     * in der Abh‰ngigkeit vom jeweiligen LigaTyp
     *
     * @param array text Referenz auf Sprachvariablen
     * @param string leer Ausgabe, falls kein Text vorhanden
     * @return string
     */
    public function spielEndeString(&$text,$tliga,$leer = "")
    {
        if ($this->spielEnde == 0) {
          $str = $leer;
        } elseif($this->spielEnde == 1 && $tliga == $text[603]) {
          $str = $text[611];
        } elseif ($this->spielEnde == 1 && $tliga != $text[603]) {
          $str = $text[1];
        } elseif ($this->spielEnde == 2 && $tliga == $text[603]) {
          $str = $text[614];
        } elseif ($this->spielEnde == 2 && $tliga != $text[603]) {
          $str = $text[0];
        } else {
          $str = $this->spielEnde;
        }   
        return $str;
    }
    /**
     * Gibt f¸r eine Partie aus, ob sie abgesagt, abgebrochen oder verschoben wurde
     *
     * @since 3.0
     * @param array text Referenz auf Sprachvariablen
     * @param string leer Ausgabe, falls keine Absagen, Abbr¸che oder Verschiebungen vorhanden
     * @return string
     */
    public function spielAbsageString(&$text,$leer = "")
    {
        if ($this->absage == 0) {
          $str = $leer;
        } elseif ($this->absage == 1) {
          $str = $text[584];
        } elseif ($this->absage == 2) {
          $str = $text[585];
        } elseif ($this->absage == 3) {
          $str = $text[586];
        } elseif ($this->absage == 4) {
          $str = $text[617];
        } else {
          $str = $this->absage;
        }
        return $str;
    }
    /**
     * Gibt f¸r eine Partie aus, ob sie abgesagt, abgebrochen oder verschoben wurde
     * ## Lange Ausf¸hrung ##
     *
     * @since 3.0
     * @param array text Referenz auf Sprachvariablen
     * @param string leer Ausgabe, falls keine Absagen, Abbr¸che oder Verschiebungen vorhanden
     * @return string
     */
    public function spielAbsagelongString(&$text)
    {
        if ($this->absage == 1) {
          $str = $text[577];
        } elseif ($this->absage == 2) {
          $str = $text[578];
        } elseif ($this->absage == 3) {
          $str = $text[579];
        } elseif ($this->absage == 4) {
          $str = $text[618];
        } else {
          $str = $this->absage;
        }
        return $str;
    }
    /**
     * Debugfunktion
     *
     */
    private function showDetails()
    {
        echo $this->heim->name." - ".$this->gast->name;
        echo " Anpfiff: ".$this->zeitString()."Uhr";
        echo " Ergebnis:".$this->hTore." - ".$this->gTore."\n";
    }
    /**
     * Debugfunktion
     *
     */
    private function showDetailsHTML()
    {
        echo "<br />".$this->heim->name." - ".$this->gast->name;
        echo " Anpfiff: ".$this->zeitString()."Uhr";
        echo " Ergebnis:".$this->hTore." - ".$this->gTore;
    }
    /**
     * Weitere Parameter zur Partie setzen.
     * z.B. S‰tze / Halbzeitergebnisse usw.
     *
     * @param mixed parameter Parameter die zu der Partie gespeichert werden sollen
     * @param string key Bezeichner unter dem der Parameter gespeichert werden soll
     */
    public function setParameter($parameter,$key="")
    {
        if (is_array($parameter)) {
          $this->otherParameter = array_merge($this->otherParameter,$parameter);
        } else {
          $this->otherParameter[$key] = $parameter;
        }
  
    }
    /**
     * Weitere Parameter zur Partie setzen.
     * z.B. S‰tze / Halbzeitergebnisse usw.
     *
     * @param string key Bezeichner des Parameters der ausgegeben werden soll, ist kein Parameter angegeben, wird das komplette array zur¸ckgegeben.
     * @return mixed Parameter
     */
    public function getParameter($key="")
    {
        if ($key == "")
            return $this->otherParameter;
        else
            return $this->otherParameter[$key];
    }
    /**
     * Speichern des Links zum Spielbericht
     *
     * @param string value Link zum Spielbericht
     * @return string
     */
    public function setreportUrl($value)
    {
        $this->reportUrl = $value;
    }
    /**
     *  Ausgabe des Links zum Spielbericht
     *  wenn als Ziel null angegeben wird, dann wird nur die URL zur¸ckgegeben
     *
     * @param string ziel Zielfenster des Links
     * @param string html Parameter
     * @return string Link zum Spielbericht
     */
    public function getreportUrl($ziel="_blank",$param="")
    {
        if (is_null($ziel))
          return $this->reportUrl;
        elseif (strpos($this->reportUrl,"http") !== 0 )
          return "<a href=\"http://".$this->reportUrl."\" target=\"".$ziel."\" $param>";
        else
          return "<a href=\"".$this->reportUrl."\" target=\"".$ziel."\" $param>";
    }
    /**
     * Spielende
     * 0 = regul‰res Ende
     * 2 = Verl‰ngerung
     * 1 = 11-Meter-Schieﬂen
     *
     * @param integer Art des Spielendes
     * @return
     */
    public function setSpielEnde($value)
    {
        if (is_int($value)) {
            $this->spielEnde = $value;
        }
    }
    /**
     * Spielende
     * 0 = regul‰res Ende
     * 2 = Verl‰ngerung
     * 1 = 11-Meter-Schieﬂen
     *
     * @param
     * @return integer Art des Spielendes
     */
    public function getSpielEnde()
    {
        return $this->spielEnde;
    }
        
} // END class Partie
