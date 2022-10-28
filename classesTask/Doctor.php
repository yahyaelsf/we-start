<?php

class Dotor{
    public $speciality;

    // Methods
    // function __construct($speciality)
    // {
    //     $this->speciality = $speciality;
    // }
    function set_speciality($speciality)
    {
        $this->speciality = $speciality;
    }
    function get_speciality()
    {
        return $this->speciality;
    }
}
$doctor = new Dotor;
$doctor->set_speciality('teath');
echo $doctor->get_speciality();