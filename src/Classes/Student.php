<?php
namespace Src\Classes;

class Student {

    private $db = null;

    public function __construct($db)
    {
        $this->db = $db;
    }

    
}