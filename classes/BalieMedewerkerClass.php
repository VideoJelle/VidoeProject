<?php
require_once('MySqlDatabaseClass.php');

class BalieMedewerkerClass
{
    //Fields
    private $idVideo;
    private $titel;
    private $beschrijving;
    private $genres;
    private $acteurs;
    private $fotopad;


    public function __construct()
    {
    }

    public static function update_aantal_beschikbaar($post)
    {
        global $database;
        //echo "123";
        $query = "UPDATE `video` 
					  SET	 `aantalBeschikbaar` = `aantalBeschikbaar` + 1
					  WHERE	 `idVideo`		=	'" . $_POST['VideoID'] . "'";
        echo $query;
        //$database->fire_query($query);

    }

    public function getIdVideo()
    {
        return $this->idVideo;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getTitel()
    {
        return $this->titel;
    }

    public function setTitel($value)
    {
        $this->titel = $value;
    }

    //setters

    public function getBeschrijving()
    {
        return $this->beschrijving;
    }

    public function setBeschrijving($value)
    {
        $this->beschrijving = $value;
    }

    public function getGenres()
    {
        return $this->genres;
    }

    public function setGenres($value)
    {
        $this->genres = $value;
    }

    public function getActeurs()
    {
        return $this->acteurs;
    }

    public function setActeurs($value)
    {
        $this->acteurs = $value;
    }


    //Constuctor

    public function getFotopad()
    {
        return $this->fotopad;
    }

    public function setFotopad($value)
    {
        $this->fotopad = $value;
    }
}