<?php
$userrole = array("klant", "bezorger", "admin", "baliemedewerker", "eigenaar");
require_once("./security.php");
?>


<?php
if (isset($_POST['reserveer'])) {
    echo "<h3 style='text-align: center;' >Item toegevoegd aan reserveringen.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    header("refresh:4;url=index.php?content=reserveringen");
    require_once("./classes/ReserveClass.php");
    ReserveClass::insert_reserveringitem_database($_POST);
} else {
    if (isset($_POST['submit'])) {

        echo "<h3 style='text-align: center;' >Item toegevoegd aan winkelmand.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
        header("refresh:4;url=index.php?content=klantHomepage");
        require_once("./classes/HireClass.php");
        HireClass::insert_winkelmanditem_database($_POST);
    } else {
        ?>
        <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <script type="text/javascript"
                    src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
            <script type="text/javascript"
                    src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
            <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css"
                  rel="stylesheet" type="text/css">
            <link href="videoPagina.css" rel="stylesheet" type="text/css">
            <style>
                .header {
                    padding: 20px;
                }
            </style>
        </head>
        <body>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12"><h2>Filmpagina</h2><br><br></div>
                </div>
                <div class="row">
                    <?php
                    require_once("classes/LoginClass.php");
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

                    $idVideo = $_GET['idVideo'];
                    $sql = "SELECT * FROM `video` 
                                 WHERE `idVideo` = '" . $idVideo . "'";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                            echo "
                            <div class=\"container\">
                                <div class=\"row\">
                                    <div class=\"col-md-4\">
                                        <img style='height: 400px' src=\"images/" . $row["fotopad"] . "\" class=\"img-responsive\">
                                    </div>
                                    <div class=\"col-md-6\">
                                        <h3>" . $row["titel"] . "</h3>
                                        <p> Genres: " . $row["genres"] . "<br>
                                            Acteurs: " . $row["acteurs"] . " <br><br>
                                            " . $row["beschrijving"] . "<br><br>";
                            if ($row["aantalBeschikbaar"] > 0) {
                                echo "Aantal beschikbaar: " . $row["aantalBeschikbaar"] . "<br><br>";
                            } else {
                                echo "<b>Deze video is helaas uitverkocht plaats een reservering om de video te kunnen huren als die weer beschikbaar is</b>";
                            }
echo "<br><br>
                            Prijs:
                            &euro; " . $row["prijs"] .
                                " </p >
                                           
                                        <p ><form role = \"form\" action='' method='post'>
                                        <input type='hidden' name='idVideo' value='" . $row['idVideo'] . "'/>
                                        <input type='hidden' name='idKlant' value='" . $_SESSION['idKlant'] . "'/>
                                        <input type='hidden' name='titel' value='" . $row['titel'] . "'/>
                                        <input type='hidden' name='aantalBeschikbaar' value='" . $row['aantalBeschikbaar'] . "'/>
                                        <input type='hidden' name='prijs' value='" . $row['prijs'] . "'/>
                                        
                                        
                                    ";
                            if ($row["aantalBeschikbaar"] > 0) {

                                echo "
                                <button type='submit' name='submit' class='btn btn - info'>Toevoegen aan winkelmand<br></button>
                                </form>
                                </div>
                                </div>
                            </div>";

                            } else {
                                echo "
                                
                                <button type='submit' name='reserveer' class='btn btn - info'>Plaats Reservatie<br></button>
                                </form>
                                </div>
                                </div>
                            </div>";
                            }


                        }
                    } else {
                        echo "Geen resultaten<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
                    }
                    $conn->close();
                    ?>
                    <br><br>
                </div>
            </div>
        </div>
        </body>
        </html>
        <?php
    }
}
?>


<!--Videoclass::IsVideoBeschikbaar($row['$id'])-->