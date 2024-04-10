<?php
/**
 * LMOLib\inc\basketballSektion
 *
 * Sektionen einer basketballLiga zB. [Round1]
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

class basketballSektion extends \LMOAPI\lib\Sektion
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
                              "Title"=>"LMOLib Basketball",
                              "Name"=>"Liga Name",
                              "Type"=>0,
                              "LigaType"=> "basketball",
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

} // End class basketballSektion Options
