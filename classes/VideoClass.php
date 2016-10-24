<?php
	require_once('MySqlDatabaseClass.php');
<<<<<<< HEAD
=======

>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
	class VideoClass
	{
		//Fields
		private $idVideo;
		private $titel;
		private $beschrijving;
		private $genres;
		private $acteurs;
		private $fotopad;
<<<<<<< HEAD
=======

>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
		//Properties
		//getters
		public function getIdVideo()
		{
			return $this->idVideo;
		}
<<<<<<< HEAD
=======

>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
		public function getTitel()
		{
			return $this->titel;
		}
<<<<<<< HEAD
=======

>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
		public function getBeschrijving()
		{
			return $this->beschrijving;
		}
<<<<<<< HEAD
=======

>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
		public function getGenres()
		{
			return $this->genres;
		}
<<<<<<< HEAD
=======

>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
		public function getActeurs()
		{
			return $this->acteurs;
		}
<<<<<<< HEAD
=======

>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
		public function getFotopad()
		{
			return $this->fotopad;
		}
<<<<<<< HEAD
=======

>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
		//setters
		public function setId($value)
		{
			$this->id = $value;
		}
<<<<<<< HEAD
=======

>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
		public function setTitel($value)
		{
			$this->titel = $value;
		}
<<<<<<< HEAD
=======

>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
		public function setBeschrijving($value)
		{
			$this->beschrijving = $value;
		}
<<<<<<< HEAD
=======

>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
		public function setGenres($value)
		{
			$this->genres = $value;
		}
<<<<<<< HEAD
=======

>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
		public function setActeurs($value)
		{
			$this->acteurs = $value;
		}
<<<<<<< HEAD
=======

>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
		public function setFotopad($value)
		{
			$this->fotopad = $value;
		}
<<<<<<< HEAD
=======


>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
		//Constuctor
		public function __construct()
		{
		}
<<<<<<< HEAD
=======

>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
		//Methods
		public static function find_by_sql($query)
		{
			// Maak het $database-object vindbaar binnen deze method
			global $database;
<<<<<<< HEAD
			// Vuur de query af op de database
			$result = $database->fire_query($query);
			// Maak een array aan waarin je VideoClass-objecten instopt
			$object_array = array();
=======

			// Vuur de query af op de database
			$result = $database->fire_query($query);

			// Maak een array aan waarin je VideoClass-objecten instopt
			$object_array = array();

>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
			// Doorloop alle gevonden records uit de database
			while ($row = mysqli_fetch_array($result)) {
				// Een object aan van de VideoClass (De class waarin we ons bevinden)
				$object = new VideoClass();
<<<<<<< HEAD
=======

>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
				// Stop de gevonden recordwaarden uit de database in de fields van een VideoClass-object
				$object->id = $row['idVideo'];
				$object->titel = $row['titel'];
				$object->beschrijving = $row['beschrijving'];
				$object->genres = $row['genres'];
				$object->fotopad = $row['fotopad'];
<<<<<<< HEAD
				$object_array[] = $object;
			}
			return $object_array;
		}
=======

				$object_array[] = $object;
			}

			return $object_array;
		}

>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
		public static function find_info_by_id($idVideo)
		{
			$query = "SELECT 	*
					  FROM 		`video`
					  WHERE		`idVideo`	=	" . $idVideo;
			$object_array = self::find_by_sql($query);
			$videoclassObject = array_shift($object_array);
<<<<<<< HEAD
			self::find_info_by_id2();
			return $videoclassObject;
		}
=======

			self::find_info_by_id2();

			return $videoclassObject;
		}

>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
		public static function find_info_by_id2()
		{
			$query2 = "SELECT b.naam FROM videoacteur AS a INNER JOIN acteur AS b ON a.idActeur = b.idActeur WHERE a.idVideo = " . $_GET['idVideo'] . " ";
			$object_array = self::find_by_sql($query2);
			$videoclassObject2 = array_shift($object_array);
<<<<<<< HEAD
			return $videoclassObject2;
		}
		public static function insert_film_database($post)
	{
		global $database;
=======

			return $videoclassObject2;
		}

		public static function insert_film_database($post)
	{
		global $database;

>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
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
<<<<<<< HEAD
		//echo $query;
		//$database->fire_query($query);
		$last_id = mysqli_insert_id($database->getDb_connection());
	}
		public static function insert_genre_film($post)
		{
            global $database;
=======

		//echo $query;

		//$database->fire_query($query);

		$last_id = mysqli_insert_id($database->getDb_connection());
	}

		public static function insert_genre_film($post)
		{
            global $database;

>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
			$query = "INSERT INTO `videogenre`(`idVideoGenre`, 
												`idVideo`, 
												`idGenre`) 
				   VALUES 						(NULL,
				   								 " . $_POST['idvanvideos'] . ",
				   								 " . $_POST['genreSelect'] . ")";
<<<<<<< HEAD
			echo $query;
            echo "<br>q " . $_POST['genreSelect'];
			//$database->fire_query($query);
			$last_id = mysqli_insert_id($database->getDb_connection());
		}
		public static function insert_acteur_film($post)
		{
			global $database;
=======

			echo $query;
            echo "<br>q " . $_POST['genreSelect'];
			//$database->fire_query($query);

			$last_id = mysqli_insert_id($database->getDb_connection());
		}

		public static function insert_acteur_film($post)
		{
			global $database;

>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
			$query = "INSERT INTO `videoacteur`(`idVideoActeur`, 
												 `idVideo`, 
												 `idActeur`) 
				   VALUES 						(NULL,
				   								 " . $_POST['idvanvideos'] . ",
				   								 " . $_POST['acteurSelect'] . ")";
<<<<<<< HEAD
			echo $query . "<br>";
			//$database->fire_query($query);
=======

			echo $query . "<br>";
			//$database->fire_query($query);

>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
			$last_id = mysqli_insert_id($database->getDb_connection());
		}
	}
?>