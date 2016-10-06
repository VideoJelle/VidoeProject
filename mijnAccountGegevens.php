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
    <link href="mijnAccountGegevens.css" rel="stylesheet" type="text/css">
    <style>
        .header {
            font-size: 24;
            padding: 20px;
        }
    </style>

<?php

require_once("classes/LoginClass.php");
if (isset($_POST['submit']))
{
    include('connect_db.php');

    $sql= "UPDATE	`login` 
			                 SET 		`naam`		=	'".$_POST['naam']."',
						                `adres`	= 	'".$_POST['adres']."',
						                `woonplaats`	= 	'".$_POST['woonplaats']."'
			                 WHERE	`id`			=	'".$_SESSION['id']."';";

    $result = mysqli_query($connection, $sql);

    echo "Uw wijziging is verwerkt. 
				U wordt doorgestuurd naar de vorige pagina";

    header("refresh:4;url=index.php?content=mijnAccountGegevens");

}
else
{
    ?>
    </head>
    <body>
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12"><h1>Mijn account</h1></div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="index.php?content=mijnAccountGegevens">Gegevens Aanpassen</a></li>
                        <li><a href="index.php?content=wijzig_wachtwoord">Wachtwoord Veranderen</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form role="form" action="index.php?content=mijnAccountGegevens" method="post">
                        <div class="form-group"><label class="control-label" for="naam">Naam<br></label>
                            <input class="form-control" id="naam" placeholder="Naam" type="text" name="naam" required></div>
                        <div class="form-group"><label class="control-label" for="adres">Adres<br></label>
                            <input class="form-control" id="adres" placeholder="Adres" type="text" name="adres" required></div>
                        <div class="form-group"><label class="control-label" for="woonplaats">Woonplaats</label>
                            <input class="form-control" id="woonplaats" placeholder="Woonplaats" type="text" name="woonplaats" required></div>
                        <button type="submit" class="btn btn-default" name="submit">Verzend</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container"></div>
    </div>
    </body>
    </html>
    <?php
}
?>