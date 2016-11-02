<?php
$userrole = array("klant", "bezorger", "admin", "baliemedewerker", "eigenaar");
require_once("./security.php");

?>

<?php
if (isset($_POST['clearCart'])) {

    header("refresh:4;url=index.php?content=klantHomepage");
    require_once("./classes/HireClass.php");
    if (!HireClass::check_if_deleveryDate_deleveryTime_exists($_POST)) {
        if (!HireClass::check_if_collectDate_collectTime_exists($_POST)) {
            echo "<h3 style='text-align: center;' >Uw gegevens zijn verwerkt. Bedankt voor uw bestelling</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
            HireClass::insert_bestelling_database($_POST);
            HireClass::clear_winkelmand($_POST);

//            Wijzigingsopdracht begin
            HireClass::trek_korting_vanaf($_POST);
//            Wijzigingsopdracht eind
        } else {
            echo "<h3 style='text-align: center;' >De ophaaltijd is niet beschikbaar, kies een andere tijd.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
        }
    } else {
        echo "<h3 style='text-align: center;' >Deze dag is niet beschikbaar, kies een andere dag.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    }

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
            <h2>Betalen</h2>
            <br><br>
            <div class="row">
                <div class="col-md-6">
                    <h3>Uw bestelling</h3>
                    <form role=\"form\" action='' method='post'>
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
                        $sql = "SELECT * FROM winkelmand WHERE `idKlant` = " . $_SESSION['idKlant'] . " ";

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
                                        &euro; " . $row["prijs"] . "
                                </td>                                
                            </tr>
                            </tbody>
                        </table>";
                            }
                        } else {
                            echo "Geen resultaten<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
                        }
                        $date = date('Y-m-d');
                        echo "<br>
                            <table class=\"table table - responsive\">
                             <thead>
                             <tr>
                                 <th>
                                         Kies de gewenste datum waarop u uw bestelling wilt ontvangen:
                                 </th>
                                 <th>
                                         <input type='date' class='form-control' name='afleverdatum' min='" . date('Y-m-d') . "' max='" . date('Y-m-d', strtotime($date . ' + 21 days')) . "' required>
                                         <input type='time' class='form-control' name='aflevertijd' min='09:00' max='17:00' step='900' required>
                                         
                                 </th>
                             </tr>
                             <tr>
                                 <th>
                                         Kies hoelaat u uw bestelling wilt laten ophalen:
                                 </th>
                                 <th>
                                        <input type='time' class='form-control' name='ophaaltijd' min='09:00' max='17:00' step='900' required>
                                 </th>
                             </tr>
                             </thead>
                         </table>
                         De video wordt een week later opgehaald, u kunt deze datum verzetten door in uw account een verlenging aan te vragen.<br>
                                                    <br>";

                        $sql = "SELECT prijs, sum(prijs) AS value FROM `winkelmand` WHERE `idKlant` = " . $_SESSION['idKlant'] . " ";
                        $result = $conn->query($sql);
                        //echo $result2;
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {

                                echo "    <table class=\"table table - responsive\">
                                            <thead>
<!-- Wijzigingsopdracht begin-->            
                                        ";
                                $totaalbedrag = $row['value'];
                                $kortingGekregen = null;
                                if (HireClass::bekijk_korting_resterend() == true) {
                                    if (HireClass::verschil_tussen_datums() == false) {
                                        $row['korting'] = (round(($row['value'] * 0.75), 2));
                                        $kortingGekregen = $row['value'] - $row['korting'];
                                        $totaalbedrag = $row['value'] - $kortingGekregen;
                                        echo "
                                            <tr>
                                                Dankzij een speciale actie is er 25% korting van uw prijs gehaald.
                                            </tr>
                                        ";
                                    } else if (HireClass::verschil_tussen_datums() == true) {
                                        $row['korting'] = (round(($row['value'] * 0.50), 2));
                                        $kortingGekregen = $row['value'] - $row['korting'];
                                        $totaalbedrag = $row['value'] - $kortingGekregen;
//                                           echo "<br>value".$row['value'];
//                                           echo "<br>prijs".$row['prijs'];
//                                           echo "<br>korting".$row['korting'];
//                                           echo "<br>kortinggekregen".$kortingGekregen;
//                                           echo "<br>totaal".$totaalbedrag;
                                        echo "
                                            <tr>
                                                Dankzij een speciale actie is er 50% korting van uw prijs gehaald.
                                            </tr>
                                        ";
                                    }
                                }
                                if ($totaalbedrag < 50) {
                                    echo "
<br><br>
<!-- Wijzigingsopdracht einde -->

                                            <tr>
                                                <th>
                                                        Verzendkosten:
                                                </th>
                                                <th>
                                                         &euro; 2.-
                                                </th>
                                            </tr>
                                            </thead>
                                        </table>";

                                    $totaalbedrag = ($totaalbedrag + 2);
                                } else {
                                    echo "";
                                }
                                echo "<table class=\"table table - responsive\">
                            <thead>
                            <tr>
                                <th>
                                        Totaal:
                                </th>
                                <th>
                                         &euro; " . $totaalbedrag . "
                                </th>
                            </tr>
                            </thead>
                        </table>
                        
                        <input type='hidden' name='prijs' value='" . $totaalbedrag . "'/>
                        ";

                            }
                        }


                        $sql = "SELECT * FROM `winkelmand` WHERE `idKlant` = " . $_SESSION['idKlant'] . " ";

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "
                                <input type='hidden' name='kortingGekregen' value='" . $kortingGekregen . "'/>
                                <input type='hidden' name='idKlant' value='" . $_SESSION['idKlant'] . "'/>
                                <input type='hidden' name='idVideo' value='" . $row['idVideo'] . "'/>
                        ";

                            }
                        }

                        echo "

                        <input type='submit' class='btn btn-info' name='clearCart' value='Betalen'>";
                        $conn->close();
                        ?>

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