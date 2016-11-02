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


        $query = "INSERT INTO `reservering` (`idReservering`, `idKlant`, `idVideo`, `titel`, `prijs`) 
                      VALUES (NULL, ". $_SESSION['idKlant'] ." ,'". $post['idVideo']."','". $post['titel']."', ". $post['prijs'].")";

//            echo $_SESSION['id'];
//            echo $post['titel'];
//            echo $post['prijs'];

        // echo $query;

        $database->fire_query($query);

        $last_id = mysqli_insert_id($database->getDb_connection());
        self::send_email($post);

    }

    private static function send_email($post)
    {
        $to = $_SESSION['email'];
        $subject = "Bevestigingsmail Reservering Videotheek Harmelen";
        $message = "Geachte heer/mevrouw<br>";

        $message .= "Hartelijk dank voor het reserveren bij Videotheek Harmelen" . "<br>";

        $message .= "Check regelmatig in uw account of de video al beschikbaar is." . "<br>";

        $message .= "De gereserveerde video is: " . $post['titel'] . "<br>";

        $message .= "Wij wensen u alvast veel kijkplezier.<br>";
        $message .= "Met vriendelijke groet," . "<br>";
        $message .= "Jelle van den Broek" . "<br>";

        $headers = 'From: no-reply@videotheekHarmelen.nl' . "\r\n";
        $headers .= 'Reply-To: webmaster@videotheekHarmelen.nl' . "\r\n";
        $headers .= 'Bcc: accountant@videotheekHarmelen.nl' . "\r\n";
        //$headers .= "MIME-version: 1.0"."\r\n";
        //$headers .= "Content-type: text/plain; charset=iso-8859-1"."\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
        $headers .= 'X-Mailer: PHP/' . phpversion();


        mail($to, $subject, $message, $headers);
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

    // <Wijzigingsopdracht>
    public static function remove_reserved_film($post)
    {
        global $database;
        $sql = "SELECT * FROM reservering WHERE `idKlant` = '".$_SESSION['idKlant']."'";
        $result = $database->fire_query($sql);
        $row = $result->fetch_assoc();
        if ($row['datumVideoBeschikbaar'] == '0000-00-00'){
            echo "<h3 style='text-align: center;' >Er is geen gereserveerde video beschikbaar op dit moment.</h3>";
        }
        else {

            // var_dump($row);
            $query =    "DELETE FROM `reservering` WHERE `idKlant` = '" . $_SESSION['idKlant'] . "' AND `datumVideoBeschikbaar` != '0000-00-00'";
//            echo $query;
            $database->fire_query($query);
        }
    }

    public static function add_reserved_film_to_order($row)
    {
        global $database;
        $query = "INSERT INTO `winkelmand`(`idWinkelmand`, `idVideo`, `titel`, `idKlant`, `prijs`) 
                  VALUES                  (null, " . $row['idVideo'] . ", '" . $row['titel'] . "', " . $_SESSION['idKlant'] . ", '" . $row['prijs'] . "')";
        //echo "<br>" . $query;
        $database->fire_query($query);
        self::lower_amount_videos($row);
    }

    public static function lower_amount_videos($row)
    {
        global $database;
        $idVideo = $row['idVideo'];
        $query = "UPDATE `video`
					  SET `aantalBeschikbaar` = `aantalBeschikbaar` - 1
					  WHERE `idVideo` = '" . $idVideo . "'";
        //echo $query;
        $database->fire_query($query);
    }
    // </Wijzigingsopdracht>

}

?>