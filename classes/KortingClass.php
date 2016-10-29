<?php
require_once('MySqlDatabaseClass.php');
require_once("LoginClass.php");
require_once("SessionClass.php");

class ActeurClass
{
    //Fields
    private $idActeurt;
    private $Acteur;


    public function getIdActeur(){ return $this->idKlacht; }
    public function getActeur(){ return $this->idKlant; }


    //setters
    public function setIdActeur($value){ $this->idKlacht = $value;}
    public function setActeur($value){ $this->klacht = $value;}

    public function __construct(){  }

    //Methods


    

}

?>