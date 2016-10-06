<?php
	require_once('MySqlDatabaseClass.php');
	
	class VideoClass
	{
		//Fields
		private $id;
		private $titel;
		private $beschrijving;
		private $genres;
		private $acteurs;
		private $fotopad;

		//Properties
		//getters
		public function getId()
		{
			return $this->id;
		}

		public function getTitel()
		{
			return $this->titel;
		}

		public function getBeschrijving()
		{
			return $this->beschrijving;
		}

		public function getGenres()
		{
			return $this->genres;
		}

		public function getActeurs()
		{
			return $this->acteurs;
		}

		public function getFotopad()
		{
			return $this->fotopad;
		}

		//setters
		public function setId($value)
		{
			$this->id = $value;
		}

		public function setTitel($value)
		{
			$this->titel = $value;
		}

		public function setBeschrijving()
		{
			$this->beschrijving = $value;
		}

		public function setGenres()
		{
			$this->genres = $value;
		}

		public function setActeurs()
		{
			$this->acteurs = $value;
		}

		public function setFotopad()
		{
			$this->fotopad = $value;
		}


		//Constuctor
		public function __construct()
		{
		}

		//Methods
		public static function find_by_sql($query)
		{
			// Maak het $database-object vindbaar binnen deze method
			global $database;

			// Vuur de query af op de database
			$result = $database->fire_query($query);

			// Maak een array aan waarin je OptredenClass-objecten instopt
			$object_array = array();

			// Doorloop alle gevonden records uit de database
			while ($row = mysqli_fetch_array($result)) {
				// Een object aan van de OptredenClass (De class waarin we ons bevinden)
				$object = new OptredenClass();

				// Stop de gevonden recordwaarden uit de database in de fields van een OptredenClass-object
				$object->id = $row['id'];
				$object->titel = $row['titel'];
				$object->beschrijving = $row['beschrijving'];
				$object->genres = $row['genres'];
				$object->acteurs = $row['acteurs'];
				$object->fotopad = $row['fotopad'];

				$object_array[] = $object;
			}
			return $object_array;
		}

		public static function find_info_by_id($id)
		{
			$query = "SELECT 	*
					  FROM 		`videos`
					  WHERE		`id`	=	" . $id;
			$object_array = self::find_by_sql($query);
			$videoclassObject = array_shift($object_array);
			return $videoclassObject;
		}

		public static function insert_tickets_database($id, $aantaltickets)
		{
			global $database;
			$query = "UPDATE `optreden`
					  SET `aantaltickets` =    '" . $aantaltickets . "'
					  WHERE `id` =             '" . $id . "'";

			$database->fire_query($query);
		}

		public static function insert_film_database($post)
		{
			global $database;

			$query = "INSERT INTO `videos` (`id`,
										   `titel`,
										   `beschrijving`,
										   `genres`,
                                           `acteurs`,
                                           `fotopad`)
					  VALUES			  (NULL,
										   '" . $post['titel'] . "',
										   '" . $post['beschrijving'] . "',
										   '" . $post['genres'] . "',
                                           '" . $post['acteurs'] . "',
                                           '" . $post['fotopad'] . "')";
			//echo $query;
			$database->fire_query($query);

			$last_id = mysqli_insert_id($database->getDb_connection());

			echo "<h3 style='text-align: center;' >Uw gegevens zijn verwerkt.</h3><br>";
		}
	}
?>