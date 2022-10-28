<?php 
class Teacher {
    public $university ;
    // Methods
    function __construct($university)
    {
        $this->university = $university;
    }
    // function set_university($university)
    // {
    //     $this->university = $university;
    // }
    function get_university()
    {
        return $this->university;
    }
}
$teacher = new Teacher('AL Azhar ');
echo $teacher->get_university();