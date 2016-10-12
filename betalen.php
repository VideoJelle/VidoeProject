<?php
$userrole = array("klant", "bezorger", "admin", "baliemedewerker", "eigenaar");
require_once("./security.php");
?>

<?php
if (isset($_POST['clearCart'])) {
    echo "<h3 style='text-align: center;' >Uw gegevens zijn verwerkt. Bedankt voor uw bestelling</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    header("refresh:4;url=index.php?content=klantHomepage");
    require_once("./classes/HireClass.php");
    if (HireClass::clear_winkelmand($_POST)){

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
        <link href="style.css" rel="stylesheet" type="text/css">
        <style>
            .header {
                font-size: 24px;
                padding: 20px;
            }

            th{
                min-width: 300px;
            }
        </style>
    </head>
    <body>
    <div class="section">
        <div class="container">
            <h2>Betalen</h2>
            <br><br>
            <div class="row">
                <div class="col-md-6">
                    <h3>Uw bestelling</h3>
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
                    $sql = "SELECT * FROM winkelmand WHERE `klantid` = " . $_SESSION['id'] . " ";
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



//                    HireClass::calculate_Price();

                    //$sql2 = "SELECT ROUND(SUM(prijs), 2) AS value FROM `winkelmand` WHERE `klantid` = " . $_SESSION['id'] . " ";
                    //$sql2 = "SELECT cast(prijs AS DECIMAL(10,2)) AS value FROM `winkelmand` WHERE `klantid` = " . $_SESSION['id'] . " ";
                      $sql2 = "SELECT cast(0 + prijs AS DECIMAL(10,2)) AS value FROM `winkelmand` WHERE `klantid` = " . $_SESSION['id'] . " ";
                    $result2 = $conn->query($sql2);

                    //echo $result2;

                    if ($result2->num_rows > 0) {
                        while ($row2 = $result2->fetch_assoc()) {
                            echo "<table class=\"table table - responsive\">
                            <thead>
                            <tr>
                                <th>
                                        Totaal:
                                </th>
                                <th>
                                         " . $row2["value"] . " Euro
                                </th>
                            </tr>
                            </thead>
                        </table>";
                        }
                    }
                    $conn->close();
                    ?>

                    <form role=\"form\" action='' method='post'>
                        <input type='hidden' name='id' value='" . $row['id'] . "'/>
                        <input type='hidden' name='klantid' value='" . $_SESSION['id'] . "'/>
                        <input type='hidden' name='titel' value='" . $row['titel'] . "'/>
                        <input type='hidden' name='prijs' value='" . $row['prijs'] . "'/>
                        <input type='submit' class="btn btn-info" name='clearCart' value='Betalen'>
                    </form>
                    <br><br><br><br><br><br>
                </div>
            </div>
        </div>
    </div>

    </body>
    </html>
    <?php
}
    ?>

<!--" . $row;-->
<!--if (($row['prijs'] < 50) && ($methode = 'leveren'))-->
<!--{-->
<!--($row['prijs'] + 2);-->
<!--} . "-->
