<?php
$userrole = array("bezorger", "admin", "eigenaar");
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
                min-width: 500px;
            }
        </style>
    </head>
    <body>
    <div class="section">
        <div class="container">
            <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Vandaag ophalen</h2>
                </div>
                <div class="col-md-6">
                    <?php

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
                    $sql = "SELECT `idVideo`,`videoTitel`,`adresKlant`,`woonplaatsKlant` FROM `bestelling` WHERE `ophaaldatum` = CURRENT_DATE ";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "
                        <table class=\"table table - responsive\">
                            <thead>
                            <tr>
                                <th>
                                        Id:
                                </th>
                                <th>
                                        Titel:
                                </th>
                                <th>
                                        Adres:
                                </th>
                                <th>
                                        Woonplaats:
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                        " . $row["idVideo"] . "
                                </td>
                                <td>
                                        " . $row["videoTitel"] . "
                                </td>
                                <td>
                                        " . $row["adresKlant"] . "
                                </td>
                                <td>
                                        " . $row["woonplaatsKlant"] . "
                                </td>
                            </tr>
                            </tbody>
                        </table>
                            ";
                        }

                    } else {
                        echo "Geen resultaten<br><br><br><br><br><br><br><br><br><br><br>";
                    }
                    $conn->close();
                    ?>
                    <br><br><br>
                </div>
            </div>
                <div class="row">
                    <div class="col-md-12">
                        <h2>Vandaag bezorgen</h2>
                    </div>
                    <div class="col-md-6">
                        <?php

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
                        $sql = "SELECT `idVideo`,`videoTitel`,`adresKlant`,`woonplaatsKlant` FROM `bestelling` WHERE `afleverdatum` = CURRENT_DATE ";

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "
                        <table class=\"table table - responsive\">
                            <thead>
                            <tr>
                                <th>
                                        Id:
                                </th>
                                <th>
                                        Titel:
                                </th>
                                <th>
                                        Adres:
                                </th>
                                <th>
                                        Woonplaats:
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                        " . $row["idVideo"] . "
                                </td>
                                <td>
                                        " . $row["videoTitel"] . "
                                </td>
                                <td>
                                        " . $row["adresKlant"] . "
                                </td>
                                <td>
                                        " . $row["woonplaatsKlant"] . "
                                </td>
                            </tr>
                            </tbody>
                        </table>
                            ";
                            }

                        } else {
                            echo "Geen resultaten<br><br><br><br><br><br><br><br><br><br><br>";
                        }
                        $conn->close();
                        ?>
                        <br><br><br>
                    </div>
                </div>
        </div>
    </div>
    </body>
    </html>


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
    </style>
</head>
<body>
<div class="section">
    <div class="container">
        <h2>Bezorger Homepage</h2>
        <br>
        <br>
        <div class="row">
            <div class="col-md-6">
                <img src="http://pingendo.github.io/pingendo-bootstrap/assets/placeholder.png" class="img-responsive">
            </div>
            <div class="col-md-6">
                <h1 class="text-primary">Titel</h1>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
                    ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis
                    dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies
                    nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
                    Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In
                    enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum
                    felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus
                    elementum semper nisi.</p>
            </div>
        </div>
    </div>
</div>

</body>
</html>
 
