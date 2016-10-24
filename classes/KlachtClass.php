<?php
require_once('MySqlDatabaseClass.php');
require_once("LoginClass.php");
require_once("SessionClass.php");

class KlachtClass
{
    //Fields
    private $idKlacht;
    private $idKlant;
    private $klacht;

    public function getIdKlacht(){ return $this->idKlacht; }
    public function getIdKlant(){ return $this->idKlant; }
    public function getKlacht(){ return $this->klacht; }

    //setters
    public function setIdKlacht($value){ $this->idKlacht = $value;}
    public function setIdKlant($value){ $this->klacht = $value;}
    public function setKlacht($value){ $this->klacht = $value;}
    public function __construct(){  }
    
    //Methods
    public static function insert_klacht_into_database($klacht)
    {
        global $database;
        $query = "INSERT INTO `klachten` (`idKlacht`, `idKlant`, `klacht`, `emailKlant`) 
                      VALUES (NULL, '" . $_SESSION['idKlant'] . "', '" .$klacht. "', '".$_SESSION['email']."')";
        //echo $_SESSION['idKlant'];
        //echo $klacht;
        // echo $query;
        $database->fire_query($query);
        $last_id = mysqli_insert_id($database->getDb_connection());
        self::send_email($klacht);
    }

    
    private static function send_email($klacht)
    {
        $to = $_SESSION['email'];
        $subject = "Bevestigingsmail Klacht Videotheek Harmelen";
        $message = "Geachte heer/mevrouw<br>";
        $message .= "Bedankt voor het indienen van uw klacht." . "<br><br>";

        $message .= "Uw bericht: " . $klacht . "<br>";

        $message .= "Wij nemen spoedig contact met u op om dit probleem op te lossen.<br>";
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
}

?>