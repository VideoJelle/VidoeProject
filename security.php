<?php
//session_start();
require_once("./classes/LoginClass.php");
require_once("./classes/SessionClass.php");
$sql2 = "SELECT * FROM reservering";
$result2 = $database->fire_query($sql2);

if ($result2->num_rows > 0) {
    while ($row2 = $result2->fetch_assoc()) {
        $today2 = date('Y-m-d');
        if ($row2['reactieDatumKlant'] == $today2) {
            $sql2 = "DELETE FROM reservering where `idVideo` = '" . $row2['idVideo'] . "' AND `idKlant` = '" . $_SESSION['idKlant'] . "'";
            //echo $sql2;
            $database->fire_query($sql2);
        } else {
            // echo $row['titel'];
            // echo "321";
        }
    }
}
if (!isset($_SESSION['idKlant'])) {
    echo "<head><style>body{overflow-y: hidden;}</style></head><h3 style='text-align: center;' >U bent niet ingelogd en daarom niet bevoegd om deze pagina te bekijken. U wordt teruggestuurd naar de loginpagina.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    header("refresh:5;url=index.php?content=inloggen_Registreren");
} else {

    if (LoginClass::check_if_geblokkeerd($_SESSION['idKlant'])) {
        if (!isset($_SESSION['idKlant'])) {

            //var_dump($_SESSION);
            echo "<h3 style='text-align: center;' >U bent niet ingelogd en daarom niet bevoegd om deze pagina te bekijken. U wordt teruggestuurd naar de loginpagina.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
            header("refresh:5;url=index.php?content=inloggen_Registreren");
            exit();

        } else if (!(in_array($_SESSION['userrole'], $userrole))) {

            echo "<h3 style='text-align: center;' >U bent niet gemachtigd en daarom niet bevoegd om deze pagina te bekijken. U wordt teruggestuurd naar uw homepagina.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
            header("refresh:5;url=index.php?content=" . $_SESSION['userrole'] . "Homepage");
            exit();

        } else {

        }
    } else {
        echo "<h3 style='text-align: center;' >U bent geblokkeerd, neem contact op met: beheer@videotheekHarmelen.nl om de blokkade op te heffen</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
        header("refresh:20;url=index.php?content=logout");
        exit();
    }

}
?>