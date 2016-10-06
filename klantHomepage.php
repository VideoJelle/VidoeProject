<?php
$userrole = array("klant", "bezorger", "admin", "baliemedewerker", "eigenaar");
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
    </style>
</head>
<body>
<div class="section">
    <div class="container">
        <h2>Klant Homepage</h2>
        <br><br>
        <div class="row">
            <div class="col-md-6">
                <h3>Winkelmand</h3>
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
                $sql = "SELECT * FROM winkelmand WHERE `klantid` = ". $_SESSION['id'] ." ";
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
                                        Prijs:
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                        " . $row["titel"] . "
                                </td>
                                <td>
                                        " . $row["prijs"] . "
                                </td>
                            </tr>
                            </tbody>
                        </table>";
                    }
                } else {
                    echo "Geen resultaten<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
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