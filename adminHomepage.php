<?php
$userrole = array("admin", "eigenaar");
require_once("./security.php");
?>

<?php
if (isset($_POST['create'])) {
    require_once("./classes/VideoClass.php");
    VideoClass::insert_film_database($_POST);
}
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
        <h2>Administrator Pagina</h2>
<br><br>
        <row class="row">
            <h3>Nieuwe film toevoegen</h3>
            <form role="form" action='index.php?content=adminHomepage' method='post'>
                <div class="form-group">
                    <label for="titel">Titel:</label>
                    <input type="text" class="form-control" name="titel" placeholder="Voer titel in.">
                </div>
                <div class="form-group">
                    <label for="beschrijving">Beschrijving:</label>
                    <input type="text" class="form-control" name="beschrijving" placeholder="Voer beschrijving in.">
                </div>
                <div class="form-group">
                    <label for="genres">Genres:</label>
                    <input type="text" class="form-control" name="genres" placeholder="Voer genres in.">
                </div>
                <div class="form-group">
                    <label for="acteurs">Acteurs:</label>
                    <input type="text" class="form-control" name="acteurs" placeholder="Voer acteurs in.">
                </div>
                <div class="form-group">
                    <label for="fotopad">Fotopad:</label>
                    <input type="text" class="form-control" name="fotopad" placeholder="Voer fotopad in.">
                </div>
                <button type="submit" name="create" class="btn btn-default">Submit</button>
            </form>
            <br>
        </row>

        <div class="row">
            <h3>Gebruiker blokkeren</h3>

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


                    $sql = "SELECT * FROM `login`";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "
                        <table class=\"table table - responsive\">
                            <thead>
                            <tr>
                                <th>
                                        E-mail:
                                </th>
                                <th>
                                        Rol:
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                        " . $row["email"] . "
                                </td>
                                <td>
                                        " . $row['userrole'] . "
                                </td>
                                <td>
                                        <form role=\"form\" action='' method='post'>
                                            <input type='submit' class=\"btn btn-info\" name='removeUser' value='Verwijder Gebruiker'>
                                            <select name='Blokkeren/Deblokkeren'>
                                                <option value='klant'>Klant</option>
                                                <option value='eigenaar'>Eigenaar</option>
                                                <option value='geblokkeerd'>Geblokkeerd</option>
                                                <option value='baliemedewerker'>Baliemedewerker</option>
                                                <option value='admin'>Admin</option>
                                                <option value='bezorger'>Bezorger</option>
                                            <input type='hidden' class=\"btn btn-info\" name='id' value='" . $row['id'] . "'/>
                                            
                                        </form>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                            ";
                                }
                        }  else {
                        echo "Geen resultaten<br><br><br><br><br><br><br>";
                    }
                    $conn->close();
                    ?>

                    <br><br>
                </div>
            </div>

        </row>
    </div>
</div>

</body>
</html>