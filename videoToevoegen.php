<?php
$userrole = array("admin", "eigenaar");
require_once("./security.php");
?>

<?php
require_once("classes/LoginClass.php");
require_once("classes/HireClass.php");
require_once("classes/SessionClass.php");
<<<<<<< HEAD
=======

>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "videotheek";
<<<<<<< HEAD
=======

>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php
if (isset($_POST['create'])) {
    echo "<h3 style='text-align: center;' >Film is toegevoegd aan database.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    //header("refresh:4;url=index.php?content=adminHomepage");
    require_once("./classes/VideoClass.php");
    VideoClass::insert_film_database($_POST);
//    VideoClass::insert_acteur_film($_POST);
//    VideoClass::insert_genre_film($_POST);
}
else {
<<<<<<< HEAD
=======

>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
    ?>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="style.css" rel="stylesheet" type="text/css">
        <style>
            .header {
                font-size: 24px;
                padding: 20px;
            }
<<<<<<< HEAD
=======

>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
            th {
                min-width: 300px;
            }
        </style>
    </head>
<body>
<div class="section">
    <div class="container">
    <div class="row">
        <div class="col-md-12"><h2>Video Toevoegen</h2></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="index.php?content=adminHomepage">Admin Homepage</a></li>
                <li><a href="index.php?content=videoToevoegen">Video's Toevoegen</a></li>
                <li><a href="index.php?content=adminHomepage">Video's beheren</a></li>
                <li><a href="index.php?content=rolWijzigen">Gebruikerrol veranderen</a></li>
                <li><a href="index.php?content=blokkeren">Gebruiker blokkeren</a></li>
                <li><a href="index.php?content=gebruikerVerwijderen">Gebruiker verwijderen</a></li>
                <li><a href="index.php?content=verwijderFilm">Video's verwijderen</a></li>
            </ul>
        </div>
    </div>
    <row class="row">

    </row>
        <h3>Nieuwe film toevoegen</h3>
            <form role='form' action='' method='post'>
                <div class='form-group'>
                    <label for='titel'>Titel:</label>
                    <input type='text' class='form-control' name='titel' placeholder='Voer titel in.'>
                </div>
                <div class='form-group'>
                    <label for='beschrijving'>Beschrijving:</label>
                    <input type='text' class='form-control' name='beschrijving' placeholder='Voer beschrijving in.'>
                </div>
                <div class='form-group'>
                    <label for='genres'>Genres:</label><br>
                        <select name='genreSelect' required>
                            <option value=""></option>
                            <?php
<<<<<<< HEAD
                            $sql = "SELECT DISTINCT b.Genre FROM videogenre AS a INNER JOIN genre AS b ON a.idGenre = b.idGenre ORDER BY Genre ASC";
                            $result = $conn->query($sql);
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row['Genre'] . "'>" . $row['Genre'] . "</option>";
                            }
=======

                            $sql = "SELECT DISTINCT b.Genre FROM videogenre AS a INNER JOIN genre AS b ON a.idGenre = b.idGenre ORDER BY Genre ASC";

                            $result = $conn->query($sql);

                            while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row['Genre'] . "'>" . $row['Genre'] . "</option>";
                            }

>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
                            ?>
                        </select>
                        &nbsp;&nbsp;
                        <select name='genreSelect'>
                            <option value=""></option>
                            <?php
<<<<<<< HEAD
                            $sql = "SELECT DISTINCT b.Genre FROM videogenre AS a INNER JOIN genre AS b ON a.idGenre = b.idGenre ORDER BY Genre ASC";
                            $result = $conn->query($sql);
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row['Genre'] . "'>" . $row['Genre'] . "</option>";
                            }
=======

                            $sql = "SELECT DISTINCT b.Genre FROM videogenre AS a INNER JOIN genre AS b ON a.idGenre = b.idGenre ORDER BY Genre ASC";

                            $result = $conn->query($sql);

                            while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row['Genre'] . "'>" . $row['Genre'] . "</option>";
                            }

>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
                            ?>
                        </select>
                        &nbsp;&nbsp;
                        <select name='genreSelect'>
                            <option value=""></option>
                            <?php
<<<<<<< HEAD
                            $sql = "SELECT DISTINCT b.Genre FROM videogenre AS a INNER JOIN genre AS b ON a.idGenre = b.idGenre ORDER BY Genre ASC";
                            $result = $conn->query($sql);
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row['Genre'] . "'>" . $row['Genre'] . "</option>";
                            }
=======

                            $sql = "SELECT DISTINCT b.Genre FROM videogenre AS a INNER JOIN genre AS b ON a.idGenre = b.idGenre ORDER BY Genre ASC";

                            $result = $conn->query($sql);

                            while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row['Genre'] . "'>" . $row['Genre'] . "</option>";
                            }

>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
                            ?>
                        </select>
                        &nbsp;&nbsp;
                </div>
                <div class='form-group'>
                    <label for='acteurs'>Acteurs:</label><br>
                        <select name='acteurSelect' required>
                            <option value=""></option>
                            <?php
<<<<<<< HEAD
                            $sql = "SELECT DISTINCT b.naam FROM videoacteur AS a INNER JOIN acteur AS b ON a.idActeur = b.idActeur ORDER BY naam ASC";
                            $result = $conn->query($sql);
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row['naam'] . "'>" . $row['naam'] . "</option>";
                            }
=======

                            $sql = "SELECT DISTINCT b.naam FROM videoacteur AS a INNER JOIN acteur AS b ON a.idActeur = b.idActeur ORDER BY naam ASC";

                            $result = $conn->query($sql);

                            while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row['naam'] . "'>" . $row['naam'] . "</option>";
                            }

>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
                            ?>
                        </select>
                    &nbsp;&nbsp;
                        <select name='acteurSelect'>
                            <option value=""></option>
                            <?php
<<<<<<< HEAD
                            $sql = "SELECT DISTINCT b.naam FROM videoacteur AS a INNER JOIN acteur AS b ON a.idActeur = b.idActeur ORDER BY naam ASC";
                            $result = $conn->query($sql);
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row['naam'] . "'>" . $row['naam'] . "</option>";
                            }
=======

                            $sql = "SELECT DISTINCT b.naam FROM videoacteur AS a INNER JOIN acteur AS b ON a.idActeur = b.idActeur ORDER BY naam ASC";

                            $result = $conn->query($sql);

                            while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row['naam'] . "'>" . $row['naam'] . "</option>";
                            }

>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
                            ?>
                        </select>
                    &nbsp;&nbsp;
                        <select name='acteurSelect'>
                            <option value=""></option>
                            <?php
<<<<<<< HEAD
                            $sql = "SELECT DISTINCT b.naam FROM videoacteur AS a INNER JOIN acteur AS b ON a.idActeur = b.idActeur ORDER BY naam ASC";
                            $result = $conn->query($sql);
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row['naam'] . "'>" . $row['naam'] . "</option>";
                            }
=======

                            $sql = "SELECT DISTINCT b.naam FROM videoacteur AS a INNER JOIN acteur AS b ON a.idActeur = b.idActeur ORDER BY naam ASC";

                            $result = $conn->query($sql);

                            while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row['naam'] . "'>" . $row['naam'] . "</option>";
                            }

>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
                            ?>
                        </select>
                    &nbsp;&nbsp;
                        <select name='acteurSelect'>
                            <option value=""></option>
                            <?php
<<<<<<< HEAD
                            $sql = "SELECT DISTINCT b.naam FROM videoacteur AS a INNER JOIN acteur AS b ON a.idActeur = b.idActeur ORDER BY naam ASC";
                            $result = $conn->query($sql);
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row['naam'] . "'>" . $row['naam'] . "</option>";
                            }
=======

                            $sql = "SELECT DISTINCT b.naam FROM videoacteur AS a INNER JOIN acteur AS b ON a.idActeur = b.idActeur ORDER BY naam ASC";

                            $result = $conn->query($sql);

                            while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row['naam'] . "'>" . $row['naam'] . "</option>";
                            }

>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
                            ?>
                        </select>
                    &nbsp;&nbsp;
                        <select name='acteurSelect'>
                            <option value=""></option>
                            <?php
<<<<<<< HEAD
                            $sql = "SELECT DISTINCT b.naam FROM videoacteur AS a INNER JOIN acteur AS b ON a.idActeur = b.idActeur ORDER BY naam ASC";
                            $result = $conn->query($sql);
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row['naam'] . "'>" . $row['naam'] . "</option>";
                            }
=======

                            $sql = "SELECT DISTINCT b.naam FROM videoacteur AS a INNER JOIN acteur AS b ON a.idActeur = b.idActeur ORDER BY naam ASC";

                            $result = $conn->query($sql);

                            while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row['naam'] . "'>" . $row['naam'] . "</option>";
                            }

>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
                            ?>
                        </select>
                    <?php
                    ?>
                </div>
                <div class='form-group'>
                    <label for='fotopad'>Fotopad:</label>
                    <input type='text' class='form-control' name='fotopad' placeholder='Voer fotopad in.'>
                </div>
                <div class='form-group'>
                    <label for='aantalBeschikbaar'>Aantal Beschikbare kopieën:</label>
                    <input type='text' class='form-control' name='aantalBeschikbaar' placeholder='Voer aantal beschikbaar in.'>
                </div>
                <?php
<<<<<<< HEAD
                $sql = "SELECT idVideo FROM video ORDER BY idVideo DESC";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $idvanvideo = ($row['idVideo']) + 1;
=======

                $sql = "SELECT idVideo FROM video ORDER BY idVideo DESC";

                $result = $conn->query($sql);

                $row = $result->fetch_assoc();

                $idvanvideo = ($row['idVideo']) + 1;

>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
                echo "
                    <input type='hidden' name='idvanvideos' value='" . $idvanvideo . "'/>
                    
                <button type='submit' name='create' class='btn btn-default'>Submit</button>";
                ?>
            </form><br>
    <?php
}
    ?>