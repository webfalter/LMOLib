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

class Sektion
{
    /**
     *
     */
    public $keyValues;
    /**
     *
     */
    public $name;
    /**
     *
     */
    public function __construct ($new_name)
    {
        $this->name = $new_name;
        $this->keyValues = array();
    }
    /**
      *
      */
    public function sektionName()
    {
        return "[".$this->name."]";
    }
    /**
      *
      */
    public function setKeyValue ($new_key,$new_value)
    {
        $this->keyValues[$new_key]=$new_value;
    }
    /**
      *
      */
    public function addKeyValue ($new_key,$new_value)
    {
        $this->keyValues[$new_key]=$new_value;
    }
    /**
      *
      */
    public function valueForKey($key)
    {
        return $this->keyValues[$key];
    }
    /**
     * Debugfunktion
     *
     * @access private
     */
    private function HTMLoutput()
    {
        echo"<br />".$this->sektionName();
        foreach ($this->keyValues as $key=>$value) {
            echo"<br />$key = $value";
        }
    }

}
