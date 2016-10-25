<?php
$userrole = array("admin", "eigenaar");
require_once("./security.php");
?>

<?php

require_once("classes/LoginClass.php");
if (isset($_POST['submit'])) {
    include('connect_db.php');

    $sql = "UPDATE	`login` 
			                 SET 		`naam`		=	'" . $_POST['naam'] . "',
						                `adres`	= 	'" . $_POST['adres'] . "',
						                `woonplaats`	= 	'" . $_POST['woonplaats'] . "'
			                 WHERE	`idKlant`			=	'" . $_SESSION['idKlant'] . "';";

    //echo $sql;
    $database->fire_query($sql);
    //$result = mysqli_query($connection, $sql);

    echo "<h3 style='text-align: center;' >Uw wijzigingen zijn verwerkt.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    header("refresh:4;url=index.php?content=mijnAccountGegevens");


} else {
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

            th {
                min-width: 300px;
            }
        </style>
    </head>
    <body>
    <div class="section">
    <div class="container">
    <div class="row">
        <div class="col-md-12"><h2>Video's beheren</h2></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="index.php?content=videoToevoegen">Video's Toevoegen</a></li>
                <li><a href="index.php?content=adminHomepage">Video's beheren</a></li>
                <li><a href="index.php?content=rolWijzigen">Gebruikerrol veranderen</a></li>
                <li><a href="index.php?content=blokkeren">Gebruiker blokkeren</a></li>
                <li><a href="index.php?content=gebruikerVerwijderen">Gebruiker verwijderen</a></li>
                <li><a href="index.php?content=verwijderFilm">Video's verwijderen</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php
            require_once("classes/LoginClass.php");
            require_once("classes/HireClass.php");
            require_once("classes/SessionClass.php");

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "videotheek";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT `titel`, `beschrijving`, `fotopad`, `prijs`, `aantalBeschikbaar` FROM `video`";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<form role=\"form\" action=\"index.php?content=adminHomepage\" method=\"post\">
                        <div class=\"form-group\"><label class=\"control-label\" for=\"titel\">Titel<br></label>
                            <input class=\"form-control\" id=\"titel\" placeholder=\"Titel\" type=\"text\" name=\"titel\" value='" . $row['titel'] . "' required></div>
                        <div class=\"form-group\"><label class=\"control-label\" for=\"beschrijving\">Beschrijving<br></label>
                            <input class=\"form-control\" id=\"beschrijving\" placeholder=\"Beschrijving\" type=\"text\" name=\"beschrijving\" value='" . $row['beschrijving'] . "' required></div>
                        <div class=\"form-group\"><label class=\"control-label\" for=\"fotopad\">Fotopad<br></label>
                            <input class=\"form-control\" id=\"fotopad\" placeholder=\"Fotopad\" type=\"text\" name=\"fotopad\" value='" . $row['fotopad'] . "' required></div>
                        <div class=\"form-group\"><label class=\"control-label\" for=\"prijs\">Prijs<br></label>
                            <input class=\"form-control\" id=\"prijs\" placeholder=\"Prijs\" type=\"text\" name=\"prijs\" value='" . $row['prijs'] . "' required></div>
                        <div class=\"form-group\"><label class=\"control-label\" for=\"aantalBeschikbaar\">Aantal Beschikbaar</label>
                            <input class=\"form-control\" id=\"aantalBeschikbaar\" placeholder=\"Aantal Beschikbaar\" type=\"text\" name=\"aantalBeschikbaar\" value='" . $row['aantalBeschikbaar'] . "' required></div>
                        <select name='genre'>";
//                                $sql4 = 'SELECT DISTINCT b.Genre FROM videogenre AS a INNER JOIN genre AS b ON a.idGenre = b.idGenre ORDER BY Genre ASC';
//                                $result4 = $conn->query($sql4);
//
//                            if ($result4->num_rows > 0) {
//                                while ($row4 = mysqli_fetch_array($result4)) {
//                                    echo "<option value='" . $row4['Genre'] . "'>" . $row4['Genre'] . "</option>";
//                                }
//                            }
                                echo "
                            </select> 
                        <button type=\"submit\" class=\"btn btn-default\" name=\"submit\">Verzend</button>
                    </form><br>
                    <hr>";

                }
                echo "
                           <br><br><br><br><br><br><br><br>
                            
                            ";


            }  else {
                echo "Geen resultaten<br><br><br><br><br><br><br><br><br><br><br>";
            }
            $conn->close();
            ?>
        </div>
    </div>
    <?php
}
//
//require_once("classes/LoginClass.php");
//if (isset($_POST['editUser'])) {
//    include('connect_db.php');
//
//    $sql = "DELETE FROM	`login` WHERE `id` = " . $_POST['id']. " ";
//
//    //echo $sql;
//    $database->fire_query($sql);
//    //$result = mysqli_query($connection, $sql);
//
//    echo "<h3 style='text-align: center;' >Uw wijzigingen zijn verwerkt.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
//    header("refresh:4;url=index.php?content=adminHomepage");
//
//} else {
//    ?>
<!--    <row class="row">-->
<!--        <h3>Film bewerken</h3>-->
<!--        <form role="form" action='index.php?content=adminHomepage' method='post'>-->
<!--            <div class="form-group">-->
<!--                <label for="titel">Titel:</label>-->
<!--                <input type="text" class="form-control" name="titel" placeholder="Voer titel in.">-->
<!--            </div>-->
<!--            <div class="form-group">-->
<!--                <label for="beschrijving">Beschrijving:</label>-->
<!--                <input type="text" class="form-control" name="beschrijving" placeholder="Voer beschrijving in.">-->
<!--            </div>-->
<!--            <div class="form-group">-->
<!--                <label for="genres">Genres:</label>-->
<!--                <input type="text" class="form-control" name="genres" placeholder="Voer genres in.">-->
<!--            </div>-->
<!--            <div class="form-group">-->
<!--                <label for="acteurs">Acteurs:</label>-->
<!--                <input type="text" class="form-control" name="acteurs" placeholder="Voer acteurs in.">-->
<!--            </div>-->
<!--            <div class="form-group">-->
<!--                <label for="fotopad">Fotopad:</label>-->
<!--                <input type="text" class="form-control" name="fotopad" placeholder="Voer fotopad in.">-->
<!--            </div>-->

<!--            <button type="submit" name="create" class="btn btn-primary">Submit</button>-->

<!--        </form>-->
<!--        <br>-->
<!--    </row>-->
<!---->
<!---->
<!--    </div>-->
<!--    </div>-->
<!---->
<!--    </body>-->
<!--    </html>-->
<!--    --><?php
//}
    ?>