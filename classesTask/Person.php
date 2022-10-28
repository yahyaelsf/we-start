<?php

class Person{
    public $name;

    // Methods
    function __construct($name)
    {
        $this->name = $name;
    }
    // function set_name($name)
    // {
    //     $this->name = $name;
    // }
    function get_name()
    {
        return $this->name;
    }
}

$person = new Person('yahya el saftawi');
echo $person->get_name();