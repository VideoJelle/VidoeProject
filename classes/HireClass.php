<?php
	require_once('MySqlDatabaseClass.php');
    require_once("LoginClass.php");
    require_once("SessionClass.php");

	class HireClass
	{
		//Fields
		private $idWinkelmand;
		private $klantid;
		private $titel;
		private $prijs;


		//Properties
		//getters
		public function getId() { return $this->id; }
		public function getKlantId() { return $this->klantid; }
		public function getTitel() { return $this->titel; }
		public function getPrijs() { return $this->prijs; }

		//setters
		public function setId($value) { $this->id = $value; }
		public function setKlantId($value) { $this->klantid = $value; }
		public function setTitel($value) { $this->titel = $value; }
		public function setPrijs($value) { $this->prijs = $value; }


		//Constuctor
		public function __construct() {}

		//Methods
        public static function insert_winkelmanditem_database($post)
        {
            global $database;

            $query = "INSERT INTO `winkelmand` (`idWinkelmand`, `idVideo`, `titel`, `idKlant`, `prijs`) 
                      VALUES (NULL, '". $post['idVideo']."', '". $post['titel']."', ". $_SESSION['idKlant'] .", ". $post['prijs'].")";

//            echo $_SESSION['id'];
//            echo $post['titel'];
//            echo $post['prijs'];

//            echo $query;
            $database->fire_query($query);

            $last_id = mysqli_insert_id($database->getDb_connection());
        }

        public static function clear_winkelmand()
        {
            global $database;

            $query =    "DELETE FROM `winkelmand` WHERE `idKlant` = " . $_SESSION['idKlant'] . " ";
//            echo $query;

            //$database->fire_query($query);
        }

        public static function remove_item_winkelmand($post)
        {
            global $database;

            $query =    "DELETE FROM `winkelmand` WHERE `idKlant` = " . $_SESSION['idKlant'] . "
                                                    AND `idWinkelmand` = " . $post["idWinkelmand"]. " ";
            echo $query;
            $database->fire_query($query);
        }

        public static function insert_bestelling_database($post)
        {
            global $database;

            $query = "INSERT INTO `bestelling`(`idBestelling`, `idVideo`, `idKlant`, `afleverdatum`, `prijs`) 
                      VALUES (NULL, ". $post['idVideo'].", ". $_SESSION['idKlant'] .", '". STR_TO_DATE('$post[\'afleverdatum\']', '%m/%d/%Y')."', ". $post['prijs']." )";

//            echo $_SESSION['id'];
//            echo $post['titel'];
//            echo $post['prijs'];

            echo $query;
            //$database->fire_query($query);

            $last_id = mysqli_insert_id($database->getDb_connection());
        }
    }
?>