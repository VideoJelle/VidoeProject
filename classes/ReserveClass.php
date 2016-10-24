<?php
	require_once('MySqlDatabaseClass.php');
    require_once("LoginClass.php");
    require_once("SessionClass.php");

	class ReserveClass
	{
		//Fields
		private $idReservering;
		private $klantid;
		private $titel;


		//Properties
		//getters
		public function getIdReservering() { return $this->idReservering; }
		public function getKlantId() { return $this->klantid; }
		public function getTitel() { return $this->titel; }

		//setters
		public function setIdReservering($value) { $this->idReservering = $value; }
		public function setKlantId($value) { $this->klantid = $value; }
		public function setTitel($value) { $this->titel = $value; }

		//Constuctor
		public function __construct() {}

		//Methods
        public static function insert_reserveringitem_database($post)
        {
            global $database;

            $query = "INSERT INTO `reservering` (`idReservering`, `idKlant`, `idVideo`, `titel`) 
                      VALUES (NULL, ". $_SESSION['idKlant'] ." ,'". $post['idVideo']."','". $post['titel']."')";

//            echo $_SESSION['id'];
//            echo $post['titel'];
//            echo $post['prijs'];

            // echo $query;
            $database->fire_query($query);

            $last_id = mysqli_insert_id($database->getDb_connection());

        }
        
        public static function check_if_reservering_exists($post)
        {
        global $database;

        $query = "SELECT * FROM `reservering`
					  WHERE	 `idVideo` = '" . $post['idVideo'] . "'
                      AND `idKlant` = '".$_SESSION['idKlant']."'";

        $result = $database->fire_query($query);
        // echo $query;
        return (mysqli_num_rows($result) == 1) ? true : false;
        }

        public static function remove_item_reservering($post)
        {
            global $database;

            $query =    "DELETE FROM `reservering` WHERE `idKlant` = " . $_SESSION['idKlant'] . "
                                                    AND `idReservering` = " . $post["idReservering"]. " ";
            //echo $query;
            $database->fire_query($query);
        }

    }
?>