<?php
/**
 * LMOLib
 *
 * Repraesentiert einen Spieltag
 * - Eine Liga hat mehrere Spieltage.
 * - An einem Spieltag finden mehrere Partien statt.
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

class Spieltag
{
    /**
      * Spieltagsnummer,
      * @var integer
      * @access public
      */
      public $nr;
    /**
      * vonDatum als string,
      * @var string
      * @access public
      */
      public $von;
    /**
      * bisDatum als string,
      * @var string
      * @access public
      */
      public $bis;
    /**
      * modus als integer,
      * 0 => Liga , jeder gegen jeden
      * 1 => pokal , KO Tunier
      *
      * @var integer
      * @access public
      */
      public $modus= 0;
    /**
      * Partien des Spieltages,
      * @var array of spieltag objects
      * @access public
      */
      public $partien;
    /**
     * Konstruktur Spieltages
     *
     */
      public function __construct($new_nr,$new_von,$new_bis,$partien=array())
      {
          $this->nr = $new_nr;
          $this->von = $new_von;
          $this->bis = $new_bis;
          $this->partien = $partien;
      }
    /**
     * Setz den Modus des Spieltags
     *  0 = Liga / 1 = Pokal-KoTunier
     *
     * @param integer Modus des Spieltags
     */
    public function setModus($value)
    {
        $this->modus = $value;
    }
    /**
     * Gib den Modus des Spieltags return
     *  0 = Liga / 1 = Pokal-KoTunier
     *
     * @return integer Modus des Spieltags
     */
    public function getModus()
    {
        return $this->modus;
    }
    /**
     * Gibt Partie der angegebener Nummer return
     *
     * @param integer Partienummer
     * @return object Die Partie
     */
    public function &partieForNumber($number)
    {
        $result = null;
    // Bugfix 13.10.04    if(isset($number) and $nNumber > 0 and $number <= $this->partienCount())
        if (isset($number) and $number > 0 and $number <= $this->partienCount())
          $result = $this->partien[$number-1];
          return $result;
    }
    /**
      * Gibt Partie der angegebener Teamnummern return
      *
      * @access public
      * @param integer Heimmannschaftsnummer integer Gastmannschaftsnummer
      * @return object Die Partie
      */
    public function &partieForTeams($heimNr,$gastNr)
    {
        $count = $this->partienCount();
        $i = -1;
        $found=-1;
        $selectedTag = null;
        while (($i<$count) and ($found<>0)):
          $i++;
          if (isset($this->partien[$i]) and ($this->partien[$i]->heim->nr = $heimNr) and
            ($this->partien[$i]->gast->nr = $gastNr))
            $found = 0;
        endwhile;
        if ($found==0) return $this->partien[$i];
        else
        return null;
    }
    /**
      * Gibt Partie der angegebener Teamnamen return
      *
      * @access public
      * @param string Heimmannschaftsname string Gastmannschaftsname
      * @return object Die Partie
      */
    public function &partieForTeamNames($heimName,$gastName)
    {
        $result = Null;
        foreach($this->partien as $aPartie){
          if(($aPartie->heim->name == $heimName ) and ($aPartie->gast->name == $gastName)){
            $result = $aPartie;
            break;
          }
        }
        return $result;
    }
    /**
      * Loescht Partie
      *
      * @access public
      * @param objekt Partie
      * @return bool Partie wurde geloescht TRUE / FALSE
      */
    public function removePartie(&$rmvPartie)
    {
        $result = False;
        reset($this->partien);
        $partienArray = $this->partien;
        $index = 0;
        foreach ($this->partien as $aPartie) {
          if ($rmvPartie == $aPartie) {
            unset($partienArray[$index]);
            $partienArray=array_values($partienArray); // Index neu erstellen
            $result = True;
            break;
          } else {
            next($partienArray);
            $index++;
          }
        }
        if (isset($partienArray)) {
          $this->partien = &$partienArray;
        } else
          $this->partien = null;
          return $result;
      }
    /**
      * Anzahl der Partien des Spieltages
      *
      * @access public
      * @return integer Partieanzahl
      */
    public function partienCount()
    {
        return count($this->partien);
    }
    /**
      * Fuegt Partie zum Spieltage hinzu
      *
      * @access public
      * @param Object die Partie
      */
    public function addPartie(&$neuePartie)
    {
        $this->partien[] = $neuePartie; // &$ Das muss so sein
    }
    /**
      * Debugfunktion
      *
      * @access private
      */
    private function showDetails()
    {
        echo "\n".$this->nr.". Spieltag (".$this->vonBisString().")\n";
        foreach ($this->partien as $partie) {
          echo $partie->showDetails()."\n";
        }
    }
    /**
      * Debugfunktion
      *
      * @access private
      */
    private function showDetailsHTML()
    {
        echo "<br />".$this->nr.". Spieltag (".$this->vonBisString().")";
        foreach ($this->partien as $partie) {
          echo "<br />".$partie->showDetailsHTML();
        }
    }
    /**
      * Gibt den Zeitrahmen aus, an dem der Spieltag ausgetragen wird
      *
      * Sind das vonDatum und das bisDatum gesetzt wird zB. 10.10.2003 - 19.10.2003 returngegeben
      * <br /> Ist eines der beiden nicht gesetzt, wird nur das Datum returngeben ohne Verbinder
      * <br /> zB. ist das vonDatum nicht gesetzt wird nur das bisDatum ausgegeben 19.10.2003 ohne Bindestrich
      * @access public
      * @return string
      */
    public function vonBisString()
    {
        $von = "";
        $bis = "";
        if ($this->von!='')
            $von = date("d.m.Y",$this->von);
        if ($this->bis!='')
            $bis = date("d.m.Y",$this->bis);
        if ($von!='' and $bis!='')
            return $von." - ".$bis;
        return $von.$bis;
    }
    /**
      * Gibt das vonDatum, an dem der Spieltag ausgetragen wird
      *
      * @access public
      * @return string
      */
    public function vonString()
    {
        $von = "";
        if ($this->von!='')
            $von = date("d.m.Y",$this->von);
        return $von;
    }
    /**
      * Gibt das bisDatum, an dem der Spieltag ausgetragen wird
      *
      * @access public
      * @return string
      */
    public function bisString()
    {
        $bis = '';
        if($this->bis!='')
          $bis = date("d.m.Y",$this->bis);
        return $bis;
    }
  
} // END class spieltag
