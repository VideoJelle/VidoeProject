<?php
$userrole = array("klant", "bezorger", "admin", "baliemedewerker", "eigenaar");
require_once("./security.php");
?>


<?php
if (isset($_POST['reserveer'])) {
    require_once("./classes/ReserveClass.php");
    ReserveClass::insert_reserveringitem_database($_POST);
} else {
    if (isset($_POST['submit'])) {
        require_once("./classes/HireClass.php");
        if (HireClass::insert_winkelmanditem_database($_POST)) {

        } else {

        }
    } else {
        ?>
        <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
            <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
            <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
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

                    $id = $_GET['id'];
                    $sql = "SELECT * FROM `videos` 
                                 WHERE `id` = '" . $id . "'";

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
                                            " . $row["beschrijving"] .
                                "</p>
                                           <br>                 
                                        <p><form role=\"form\" action='' method='post'>
                                        <input type='hidden' name='id' value='" . $row['id'] . "'/>
                                        <input type='hidden' name='klantid' value='" . $_SESSION['id'] . "'/>
                                        <input type='hidden' name='titel' value='" . $row['titel'] . "'/>
                                        <input type='hidden' name='prijs' value='" . $row['prijs'] . "'/>
                                                <button type=\"submit\" name=\"submit\" class=\"btn btn-info\">Toevoegen aan winkelmand<br></button>
                                                <button type=\"submit\" name=\"reserveer\" class=\"btn btn-info\">Plaats Reservatie<br></button>
                                                &nbsp; Prijs: " . $row["prijs"] . "</p>
                                        </form>
                                        
                                    </div>
                                </div>
                            </div>";
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