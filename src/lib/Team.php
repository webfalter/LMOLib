<?php
/**
 * LMOLib
 *
 * Mannschaft (Team), die an einer Liga teilnimmt
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

class Team
{
    /**
     * Name der Mannschaft
     * @var string
     */
    public $name;
    /**
     * Kurzbezeichnung (max.5 Zeichen)
     * @var string
     */
    public $kurz;
    /**
     * Mittellanger Teamname
     * @var string
     */
    public $mittel;
    /**
     * Nummer der Mannschaft, entspricht der Nr aus dem Ligafile
     * @var integer
     */
    public $nr;
    /**
     * KeyValue Paare, die in der Team Sektion angegeben wurden.
     *
     * Beispiel:
     * In einem LigaFile existiert in der Sektion [Team2] der Eintrag URL=http://www.hsv.de
     * Um die URL des Teams anzusprechen schreibt man: $url = $myTeam->keyValues['URL'];
     *
     * @var array
     */
    public $keyValues = array();
    /**
     * Kontruktor der Klasse Team
     *
     * @param string   $name
     * @param string   $kurz
     * @param integer  $nr
     * @param string   $mittel
     */
    public function __construct($name="",$kurz="",$nr="",$mittel="")
    {
        $this->name = (string)$name;
        $this->kurz = (string)$kurz;
        $this->mittel = (string)$mittel;
        $this->nr = (int)$nr;
        $this->keyValues = array("SP"=>0,"SM"=>0,"TOR1"=>0,"TOR2"=>0,"STDA"=>0,"URL"=>"","NOT"=>"");
    }
    /**
     * Fügt ein neues KeyValue Paar hinzu
     *
     * @param string   $new_key
     * @param string   $new_value
     * @return array   $keyValues
     */
    private function addKeyValue ($new_key,$new_value)
    {
        $this->keyValues[$new_key]=$new_value;
    }
    /**
     * Gibt value zu einem Key zurück
     *
     * @param string  $new_key
     * @return string $keyValues
     */
    private function valueForKey($new_key)
    {
        return $this->keyValues[$new_key];
    }

} // END class Team

