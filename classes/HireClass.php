<?php
	require_once('MySqlDatabaseClass.php');

	class HireClass
	{
		//Fields
		private $id;
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

            $query = "INSERT INTO `winkelmand` (`id`, `klantid`, `titel`, `prijs`) 
                      VALUES (NULL, ". $_SESSION['id'] ." ,'". $post['titel']."','". $post['prijs']."')";

//            echo $_SESSION['id'];
//            echo $post['titel'];
//            echo $post['prijs'];

            //echo $query;
            $database->fire_query($query);

            $last_id = mysqli_insert_id($database->getDb_connection());

			echo "<h3 style='text-align: center;' >Uw gegevens zijn verwerkt.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
            header("refresh:4;url=index.php?content=klantHomepage");
        }

        public static function clear_winkelmand()
        {
            global $database;

            $query =    "DELETE * FROM `winkelmand` WHERE `id` = '" . $_SESSION['id'] . "'";
            $database->fire_query($query);
        }
    }
?>