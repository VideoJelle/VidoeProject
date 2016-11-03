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

    public function getFotopad()
    {
        return $this->fotopad;
    }

    public function setFotopad($value)
    {
        $this->fotopad = $value;
    }

    public function __construct()
    {
    }

    public static function update_aantal_beschikbaar($post)
    {

        date_default_timezone_set("Europe/Amsterdam");

        $date = date('Y-m-d');
        $datumreactie = date('Y-m-d', strtotime("+7 days"));
        global $database;


        //echo "123";

        $query = "UPDATE `video`
					  SET	 `aantalBeschikbaar` = `aantalBeschikbaar` + 1 
					  WHERE	 `idVideo`		=	'" . $_POST['idVideo'] . "'";


        $query2 = "UPDATE `reservering`
                    SET `datumVideoBeschikbaar` = '" . $date . "'
                    WHERE `idVideo` = '" . $_POST['idVideo'] . "'";
        $query3 = "UPDATE `reservering`
                    SET `reactieDatumKlant` = '" . $datumreactie . "'
                    WHERE `idVideo` = '" . $_POST['idVideo'] . "'";


        // echo $query;
        // echo $query2;
        $database->fire_query($query);
        // </Wijzigingsopdracht>
        $database->fire_query($query2);
        $database->fire_query($query3);

        $sql1 = "SELECT a.email FROM login AS a INNER JOIN reservering AS b ON a.idKlant = b.idKlant where idVideo = '" . $_POST['idVideo'] . "'";
        $result = $database->fire_query($sql1);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                self::send_email($row['email']);
            }
        }


    }

    private static function send_email($email)
    {
        $to = $email;
        $subject = "Activatiemail Videotheek Harmelen";
        $message = "Dear sir/madam <br> ";

        $message .= '<style>a { color:red;}</style>';
        $message .= "Your reserved video is available<br>";
        $message .= "Log in on your account to hire the video" . "<br>";
        $message .= "Your reservation ends in 7 days." . "<br>";
        $message .= "Greetings," . "<br>";
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

    public static function remove_item_reservering($post)
    {
        global $database;


        $query = "DELETE FROM `reservering` WHERE `idKlant` = " . $_SESSION['idKlant'] . "
                                                    AND `idReservering` = " . $post["idReservering"] . " ";
        //echo $query;


        $database->fire_query($query);
    }
}
