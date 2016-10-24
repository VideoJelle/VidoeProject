<?php
	require_once('MySqlDatabaseClass.php');
	class VideoClass
	{
		//Fields
		private $idVideo;
		private $titel;
		private $beschrijving;
		private $genres;
		private $acteurs;
		private $fotopad;
		//Properties
		//getters
		public function getIdVideo()
		{
			return $this->idVideo;
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
		public function setBeschrijving($value)
		{
			$this->beschrijving = $value;
		}
		public function setGenres($value)
		{
			$this->genres = $value;
		}
		public function setActeurs($value)
		{
			$this->acteurs = $value;
		}
		public function setFotopad($value)
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
			// Maak een array aan waarin je VideoClass-objecten instopt
			$object_array = array();
			// Doorloop alle gevonden records uit de database
			while ($row = mysqli_fetch_array($result)) {
				// Een object aan van de VideoClass (De class waarin we ons bevinden)
				$object = new VideoClass();
				// Stop de gevonden recordwaarden uit de database in de fields van een VideoClass-object
				$object->id = $row['idVideo'];
				$object->titel = $row['titel'];
				$object->beschrijving = $row['beschrijving'];
				$object->genres = $row['genres'];
				$object->fotopad = $row['fotopad'];
				$object_array[] = $object;
			}
			return $object_array;
		}
		public static function find_info_by_id($idVideo)
		{
			$query = "SELECT 	*
					  FROM 		`video`
					  WHERE		`idVideo`	=	" . $idVideo;
			$object_array = self::find_by_sql($query);
			$videoclassObject = array_shift($object_array);
			self::find_info_by_id2();
			return $videoclassObject;
		}
		public static function find_info_by_id2()
		{
			$query2 = "SELECT b.naam FROM videoacteur AS a INNER JOIN acteur AS b ON a.idActeur = b.idActeur WHERE a.idVideo = " . $_GET['idVideo'] . " ";
			$object_array = self::find_by_sql($query2);
			$videoclassObject2 = array_shift($object_array);
			return $videoclassObject2;
		}
		public static function insert_film_database($post)
	{
		global $database;
		$query = "INSERT INTO `video` (`idVideo`,
										   `titel`,
										   `beschrijving`,
										   `fotopad`,
                                           `aantalBeschikbaar`)
					  VALUES			  (NULL,
										   '" . $post['titel'] . "',
										   '" . $post['beschrijving'] . "',
										   '" . $post['fotopad'] . "',
                                           '" . $post['aantalBeschikbaar'] . "')";
		//echo $query;
		//$database->fire_query($query);
		$last_id = mysqli_insert_id($database->getDb_connection());
	}
		public static function insert_genre_film($post)
		{
            global $database;
			$query = "INSERT INTO `videogenre`(`idVideoGenre`, 
												`idVideo`, 
												`idGenre`) 
				   VALUES 						(NULL,
				   								 " . $_POST['idvanvideos'] . ",
				   								 " . $_POST['genreSelect'] . ")";
			echo $query;
            echo "<br>q " . $_POST['genreSelect'];
			//$database->fire_query($query);
			$last_id = mysqli_insert_id($database->getDb_connection());
		}
		public static function insert_acteur_film($post)
		{
			global $database;
			$query = "INSERT INTO `videoacteur`(`idVideoActeur`, 
												 `idVideo`, 
												 `idActeur`) 
				   VALUES 						(NULL,
				   								 " . $_POST['idvanvideos'] . ",
				   								 " . $_POST['acteurSelect'] . ")";
			echo $query . "<br>";
			//$database->fire_query($query);
			$last_id = mysqli_insert_id($database->getDb_connection());
		}
	}
?>