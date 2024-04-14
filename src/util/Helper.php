<?php
/**
 * Helper
 *
 * Hilfsfunktionen zum Objekt Liga
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

namespace LMOLib\util;

use function class_exists;
use function file_exists;

class Helper
{
    /**
     *
     */
    public function __construct()
    {
        
    }
    /**
     * <br> getLigaObject
     * <br> die Funktion sucht den Parameter LigaType im Ligafile und gibt passend hierzu ein
     * <br> Object der Klassen liga oder einer der Kindklassen zurück
     *
     * @version 1.0
     * @since 2.7
     * @param string file Pfad zur Ligadatei (*.l98)
     * @return object ein object passend zum Ligafile
     */
    public static function getLigaObject($file)
    {
        if (file_exists($file) ) {
            $ligaFile = file($file);
            foreach ($ligaFile as $configLine) {
                if (preg_match("/^LigaType=([^\n]+)/",$configLine,$ligaType) ) {
                    break;
                }
            }
            $ligaType[1] .= "Liga";
            $ligaNewType = '\\LMOLib\\lib\\'.$ligaType[1];
            if (class_exists($ligaNewType))
                return new $ligaNewType();
            else return new \LMOLib\lib\Liga();
        } else return false;
        
    }
  
} //End class Helper
