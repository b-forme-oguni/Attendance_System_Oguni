<?php

namespace app\Library;

class ExcelTable
{
    private $day = '';
    private $start = '';
    private $end = '';
    private $food_fg = '';
    private $outside_fg = '';
    private $medical_fg = '';
    private $note = '';

    function __construct($day, $record)
    {
        $this->day = $day;
        if (isset($record)) {
            $this->start = $record['start'];
            $this->end = $record['end'];
            $this->food_fg = $record['food_fg'];
            $this->outside_fg = $record['outside_fg'];
            $this->medical_fg = $record['medical_fg'];
            $this->note = $record['note']['note'];
        }
    }

    /**
     * Get the value of day
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Get the value of start
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Get the value of end
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Get the value of food_fg
     */
    public function getFood_fg()
    {
        if ($this->food_fg) {
            return '1';
        }
        return '';
    }


    /**
     * Get the value of outside_fg
     */
    public function getOutside_fg()
    {
        if ($this->outside_fg) {
            return '1';
        }
        return '';
    }

    /**
     * Get the value of medical_fg
     */
    public function getMedical_fg()
    {

        if ($this->medical_fg) {
            return '2';
        }
        return '';
    }

    /**
     * Get the value of note
     */
    public function getNote()
    {
        return $this->note;
    }
}
