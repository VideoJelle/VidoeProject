<!DOCTYPE html>
<html>
<head>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title></title>
</head>
</html>

<?php
require_once("MySqlDatabaseClass.php");
require_once("UsersClass.php");
require_once("VideoClass.php");

class LoginClass
{
	//Fields
	private $id;
	private $email;
	private $password;
	private $userrole;
	private $activated;
	private $activationdate;

	//Properties
	public function getId() { return $this->id; }
	public function getEmail() { return $this->email;}
	public function getPassword() { return $this->password; }
	public function getUserrole() { return $this->userrole; }
	public function getActivated() { return $this->activated;}
	public function getActivationdate() { return $this->activationdate; }

	public function setId($value) { $this->id = $value; }
	public function setEmail($value) { $this->email = $value;}
	public function setPassword($value) { $this->password = value; }
	public function setUserrole($value) { $this->userrole = $value; }
	public function setActivated($value) { $this->activated = $value;}
	public function setActivationdate($value) { $this->activationdate = value; }


	//Constructor
	public function __construct() {}

	//Methods
	/* Hier komen de methods die de informatie in/uit de database stoppen/halen
    */
	public static function find_by_sql($query)
	{
		// Maak het $database-object vindbaar binnen deze method
		global $database;

		// Vuur de query af op de database
		$result = $database->fire_query($query);

		// Maak een array aan waarin je LoginClass-objecten instopt
		$object_array = array();

		// Doorloop alle gevonden records uit de database
		while ( $row  = mysqli_fetch_array($result))
		{
			// Een object aan van de LoginClass (De class waarin we ons bevinden)
			$object = new LoginClass();

			// Stop de gevonden recordwaarden uit de database in de fields van een LoginClass-object
			$object->id				= $row['id'];
			$object->email			= $row['email'];
			$object->password		= $row['password'];
			$object->userrole		= $row['userrole'];
			$object->activated		= $row['activated'];
			$object->activationdate = $row['activationdate'];

			$object_array[] = $object;
		}
		return $object_array;
	}

	public static function find_login_by_email_password($email, $password)
	{
		$query = "SELECT *
					  FROM `login`
					  WHERE `email` 	= '".$email."'
					  AND	`password`	= '".$password."'";

		$loginClassObjectArray = self::find_by_sql($query);
		$loginClassObject = array_shift($loginClassObjectArray);
		return $loginClassObject;
	}


	public static function insert_into_database($post)
	{
		global $database;

		date_default_timezone_set("Europe/Amsterdam");

		$date = date('Y-m-d H:i:s');

		$password = MD5($post['email'].date('Y-m-d H:i:s'));

		$query = "INSERT INTO `login` (`id`,
										   `email`,
										   `password`,
										   `userrole`,
										   `activated`,
										   `activationdate`)
					  VALUES			  (NULL,
										   '".$post['email']."',
										   '".$password."',
										   'klant',
										   'no',
										   '".$date."')";
		//echo $query;
		$database->fire_query($query);

		$last_id = mysqli_insert_id($database->getDb_connection());

		UsersClass::insert_into_database($last_id, $post);

		self::send_email($last_id, $post, $password);

		echo "<h3 style='text-align: center;' >Uw gegevens zijn verwerkt.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
		header("refresh:3;url=index.php?content=inloggen_Registreren");
	}

	public static function check_if_email_exists($email)
	{
		global $database;

		$query = "SELECT `email`
					  FROM	 `login`
					  WHERE	 `email` = '".$email."'";

		$result = $database->fire_query($query);

		//ternary operator
		return (mysqli_num_rows($result) > 0) ? true : false;
	}


	public static function check_if_email_password_exists($email, $password, $activated)
	{
		global $database;

		$query = "SELECT `email`, `password`, `activated`
					  FROM	 `login`
					  WHERE	 `email` = '".$email."'
					  AND	 `password` = '".$password."'";

		$result = $database->fire_query($query);

		$record = mysqli_fetch_array($result);

		return (mysqli_num_rows($result) > 0 && $record['activated'] == $activated) ? true : false;
	}

	public static function check_if_activated($email, $password)
	{
		global $database;

		$query = "SELECT `activated`
					  FROM	 `login`
					  WHERE	 `email` = '".$email."'
					  AND	 `password` = '".$password."'";

		$result = $database->fire_query($query);
		$record = mysqli_fetch_array($result);

		return ( $record['activated'] == 'no') ? true : false;
	}

	private static function send_email($id, $post, $password)
	{
		$to = $post['email'];
		$subject = "Activatiemail Videotheek Harmelen";
		$message = "Geachte heer/mevrouw <b>".$post['firstname']." ".
			$post['infix']." ".
			$post['lastname']."</b><br>";

		$message .= '<style>a { color:red;}</style>';
		$message .= "Hartelijk dank voor het registreren bij Videotheek Harmelen"."<br>";
		$message .= "Uw registratienummer is: ".$id."<br>";
		$message .= "U kunt de registratie voltooien door op de onderstaande"."<br>";
		$message .= "activatielink te klikken:"."<br>";

		$message .= "klik <a href='".MAIL_PATH."index.php?content=activate&id=".$id."&email=".$post['email']."&password=".$password."'>hier</a> om uw account te activeren"."<br>";

		$message .= "U kunt dan vervolgens een nieuw wachtwoord instellen."."<br>";
		$message .= "Met vriendelijke groet,"."<br>";
		$message .= "Jelle van den Broek"."<br>";

		$headers = 'From: no-reply@videotheekharmelen.nl'."\r\n";
		$headers .= 'Reply-To: webmaster@videotheekharmelen.nl'."\r\n";
		$headers .= 'Bcc: accountant@videotheekharmelen.nl'."\r\n";
		//$headers .= "MIME-version: 1.0"."\r\n";
		//$headers .= "Content-type: text/plain; charset=iso-8859-1"."\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1"."\r\n";
		$headers .= 'X-Mailer: PHP/' . phpversion();



		mail( $to, $subject, $message, $headers);
	}

	public static function activate_account_by_id($id)
	{
		global $database;
		$query = "UPDATE `login`
					  SET `activated` = 'yes'
					  WHERE `id` = '".$id."'";

		$database->fire_query($query);

	}

	public static function update_password($id, $password)
	{
		global $database;
		$query = "UPDATE `login` 
					  SET	 `password` =	'".MD5($password)."'
					  WHERE	 `id`		=	'".$id."'";
		$database->fire_query($query);
		echo "Uw wachtwoord is succesvol gewijzigd.";

		header("refresh:4;url=index.php?content=inloggen_Registreren");
	}

	public static function check_old_password($old_password)
	{
		$query = "SELECT *
					  FROM	 `login`
					  WHERE	 `id`	=	'".$_SESSION['id']."'";
		$arrayLoginClassObjecten = self::find_by_sql($query);
		$loginClassObject = array_shift($arrayLoginClassObjecten);
		//var_dump($loginClassObject);
		//echo $loginClassObject->getPassword()."<br>";
		//echo MD5($old_password);
		if (!strcmp(MD5($old_password),$loginClassObject->getPassword()))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public static function subtract_tickets($idticket, $aantaltickets)
	{
		global $database;

		$query =    "UPDATE `optreden`
                        SET `aantaltickets` = (aantaltickets - '" . $aantaltickets . "')
                        WHERE `idticket` = '" . $idticket . "'";


		$database->fire_query($query);
	}

	public static function add_tickets($id, $aantaltickets)
	{
		global $database;

		$query =   "UPDATE `users` SET `aantaltickets` = '".$aantaltickets."'";

		$database->fire_query($query);

		$ticketnummer = rand(1, 99999999999);

		self::send_email2($ticketnummer);
	}

	private static function send_email2($ticketnummer)
	{
		$to = "naam@mail.nl";
		$subject = "Reserveringsmail Videotheek Harmelen.";
		$message = "Geachte heer/mevrouw <br>";

		$message .= '<style>a { color:red;}</style>';
		$message .= "Hartelijk dank voor het reserveren van een optreden bij Videotheek Harmelen."."<br>";
		$message .= "Uw ticketnummer is: ".$ticketnummer."<br>";
		$message .= "Print deze email uit en neem hem mee naar de voorstelling."."<br>";
		$message .= "Als u niet voor gegeven tijd komt opdagen kunnen wij u niet geld teruggeven."."<br>";
		$message .= "Als u de bestelling niet geannuleerd heeft voor het concert begint kunnen wij u niet geld teruggeven."."<br>";
		$message .= "Met vriendelijke groet,"."<br>";
		$message .= "De Melkweg"."<br>";

		$headers = 'From: no-reply@videotheekharmelen.nl'."\r\n";
		$headers .= 'Reply-To: info@videotheekharmelen.nl'."\r\n";
		$headers .= 'Cc: admin@videotheekharmelen.nl'."\r\n";
		$headers .= 'Bcc: accountant@videotheekharmelen.nl'."\r\n";
		//$headers .= "MIME-version: 1.0"."\r\n";
		//$headers .= "Content-type: text/plain; charset=iso-8859-1"."\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1"."\r\n";
		$headers .= 'X-Mailer: PHP/' . phpversion();


		mail( $to, $subject, $message, $headers);
	}

	private static function send_email3()
	{
		$to = "zaalbeheerder@mail.nl";
		$subject = "Reserveringsmail Videotheek Harmelen.";
		$message = "Geachte heer/mevrouw <br>";

		$message .= '<style>a { color:red;}</style>';
		$message .= "Geachte zaalbeheerder."."<br>";
		$message .= "Een van de films is uitverkocht"."<br>";
		$message .= "Ga naar: http://localhost/2014-2015/website/index.php?content=zaalbeheerderHomepage voor meer informatie"."<br>";
		$message .= "Met vriendelijke groet,"."<br>";
		$message .= "Videotheek Harmelen"."<br>";

		$headers = 'From: no-reply@videotheekharmelen.nl'."\r\n";
		$headers .= 'Reply-To: info@videotheekharmelen.nl'."\r\n";
		$headers .= 'Cc: admin@videotheekharmelen.nl'."\r\n";
		$headers .= 'Bcc: accountant@videotheekharmelen.nl'."\r\n";
		//$headers .= "MIME-version: 1.0"."\r\n";
		//$headers .= "Content-type: text/plain; charset=iso-8859-1"."\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1"."\r\n";
		$headers .= 'X-Mailer: PHP/' . phpversion();


		mail( $to, $subject, $message, $headers);
	}
}
?>