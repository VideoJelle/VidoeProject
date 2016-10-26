<?php
$userrole = array("klant");
require_once("./security.php");
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
                min-width: 250px;
            }
        </style>
    </head>
    <body>
    <div class="section">
        <div class="container">
            <div class="container">
                <div class="row">
                    <div class="col-md-12"><h2>Mijn Bestellingen</h2></div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li><a href="index.php?content=klantHomepage">Winkelmand</a></li>
                            <li><a href="index.php?content=mijnBestellingen">Mijn bestellingen</a></li>
                            <li><a href="index.php?content=reserveringen">Reserveringen</a></li>
                            <li><a href="index.php?content=klachtIndienen">Klacht indienen</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
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
                    $sql = "SELECT * FROM bestelling WHERE `idKlant` = " . $_SESSION['idKlant'] . " ";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "
                        <table class=\"table table - responsive\">
                            <thead>
                            <tr>
                                <th>
                                    Titel:
                                </th>
                                <th>
                                    Afleverdatum:
                                </th>     
                                <th>
                                    Ophaaldatum:
                                </th>
                                <th>
                                    Prijs:
                                </th>
                                
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                        " . $row["idVideo"]  . "
                                </td>
                                <td>
                                        " . $row["afleverdatum"] . "
                                </td>
                                <td>
                                        " . $row["ophaaldatum"] . "
                                </td>
                                <td>
                                        " . $row["prijs"] . "
                                </td>
                                <td>
                                        <form role=\"form\" action='' method='post'>
                                            <input type='submit' class=\"btn btn-info\" name='add7days' value='Verleng Bestelling'>
                                            <input type='hidden' class=\"btn btn-info\" name='idWinkelmand' value='" . $row['idBestelling'] . "'/>
                                        </form>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                            ";
                        }
                        /*echo "
                            <form role='form' action='index.php?content=betalen' method='post'>
                                <input type='hidden' name='id' value='" . $row['id'] . "'/>
                                <input type='hidden' name='klantid' value='" . $_SESSION['idKlant'] . "'/>
                                <input type='hidden' name='idVideo' value='" . $row['idVideo'] . "'/>
                                <input type='hidden' name='titel' value='" . $row['titel'] . "'/>
                                <input type='hidden' name='prijs' value='" . $row['prijs'] . "'/>
                                <input type='submit' class='btn btn - info' name='betalen' value='Betalen'>
                            </form><br><br><br><br><br><br><br><br>";
                            */
                    }  else {
                        echo "Geen resultaten<br><br><br><br><br><br><br><br><br><br><br>";
                    }
                    $conn->close();
                    ?>
                    <br><br><br><br><br><br>
                </div>
            </div>

        </div>
    </div>
    </body>
    </html>