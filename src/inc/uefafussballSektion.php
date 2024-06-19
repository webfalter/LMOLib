<?php
/**
 * LMOLib\inc\uefafussballSektion
 *
 * Sektionen einer uefafussballLiga zB. [Round1]
 * Uefa Modus 2024
 *
 * @author Tim Schumacher
 * @author Rene Marth
 * @author Markus Doerfling
 * @author Marcus Schug
 * @author Torsten Hofmann
 *
 * @package LMOLib
 *
 * @version 5.0.1
 *
 */
declare(strict_types=1);

namespace LMOLib\inc;

use function get_class;

class uefafussballSektion extends \LMOAPI\lib\Sektion
{
    /**
     * Nummer der Liga,
     * @var array Liga objekt
     * @access public
     */
    public $aLiga;
    /**
     * Mit diesen Optionen wird ein neus Ligafile erzeugt
     * @var array of predefined keyValues
     * @access public
     */
    public $keyValues = array(
                              "Title"=>"LMOLib Fussball",
                              "Name"=>"Liga Name",
                              "Type"=>0,
                              "LigaType"=> "fussball",
                              "Teams"=>0,
                              "vonTab"=>0,
                              "bisTab"=>0,
                              "Rounds"=>0,
                              "Matches"=>0,
                              "Actual"=>0,
                              "Kegel"=>0,
                              "HandS"=>0,
                              "PointsForWin"=>3,
                              "PointsForDraw"=>1,
                              "PointsForLost"=>0,
                              "Spez"=>0,
                              "HideDraw"=>0,
                              "OnRun"=>0,
                              "MinusPoints"=>0,
                              "Direct"=>0,
                              "Champ"=>1,
                              "CL"=>0,
                              "CK"=>0,
                              "UC"=>0,
                              "AR"=>0,
                              "AB"=>2,
                              "namePkt"=>"Pkt.",
                              "nameTor"=>"Tore",
                              "DatC"=>1,
                              "DatS"=>1,
                              "DatM"=>1,
                              "DatF"=>"%a.%d.%m. %H:%M",
                              "urlT"=>0,
                              "urlB"=>0,
                              "stats"=>0,
                              "Graph"=>1,
                              "Kreuz"=>1,
                              "favTeam"=>0,
                              "selTeam"=>0,
                              "kurve1"=>0,
                              "kurve2"=>0,
                              "ticker"=>0,
                              );
    /**
     * Konstruktor
     *
     * @param string liga $aLiga
     * @param array $optionDetails
     * @return array optionsSektion
     * @access public
     */
    public function __construct ($aLiga="",$optionDetails="")
    {
        $this->name = "Options";
        if ($optionDetails <> "") {
            foreach($optionDetails as $key=>$values) {
                $this->keyValues[$key] = $values;
            }
        }
// Wenn eine Liga angegeben wird, werden entsprechende Keys gleich initialisiert
        if (get_class($aLiga)=="liga") {
            if (isset($aLiga->name) and $aLiga->name != "")
                $this->keyValues['Name'] = $aLiga->name;
            if (isset($aLiga->aktSpTag) and $aLiga->aktSpTag != "")
                $this->keyValues['Actual'] = $aLiga->aktSpTag;
                $this->keyValues['Teams'] = $aLiga->teamCount();
                $this->keyValues['Rounds'] = $aLiga->spieltageCount();
    // Key "Matches" bestimmen
            foreach ($aLiga->spieltage as $spieltag) {
                if ($spieltag->partienCount() > $this->keyValues['Matches'])
                    $this->keyValues['Matches'] = $spieltag->partienCount();
            }
        }
  }

} // End class uefafussballSektion Options
