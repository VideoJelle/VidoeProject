<?php
	require_once('MySqlDatabaseClass.php');
    require_once("LoginClass.php");
    require_once("SessionClass.php");

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
        }

        public static function clear_winkelmand()
        {
            global $database;

            $query =    "DELETE FROM `winkelmand` WHERE `klantid` = " . $_SESSION['id'] . " ";
//            echo $query;

            $database->fire_query($query);
        }

        public static function remove_item_winkelmand($post)
        {
            global $database;

            $query =    "DELETE FROM `winkelmand` WHERE `klantid` = " . $_SESSION['id'] . "
                                                    AND `id` = " . $post["id"]. " ";
//            echo $query;
            $database->fire_query($query);
        }
//
//        public static function calculate_Price()
//        {
//            $servername = "localhost";
//            $username = "root";
//            $password = "";
//            $dbname = "videotheek";
//
//            $conn = new mysqli($servername, $username, $password, $dbname);
//
//            if ($conn->connect_error) {
//                die("Connection failed: " . $conn->connect_error);
//            }
//
//            $sql = "SELECT ROUND(SUM(prijs), 2) AS value FROM `winkelmand` WHERE `klantid` = " . $_SESSION['id'] . " ";
//            $result = $conn->query($sql);
//
//            if ($result->num_rows > 0) {
//                while ($row = $result->fetch_assoc()) {
//                    echo "<table class=\"table table - responsive\">
//                            <thead>
//                            <tr>
//                                <th>
//                                        Totaal:
//                                </th>
//                                <th>
//                                         " . $row["value"] . " Euro
//                                </th>
//                            </tr>
//                            </thead>
//                        </table>";
//                }
//            }
//        }
    }
?>