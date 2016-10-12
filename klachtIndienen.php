<?php
$userrole = array("klant", "bezorger", "admin", "baliemedewerker", "eigenaar");
require_once("./security.php");
?>

<?php
if (isset($_POST['submit'])) {
    $naamklantKlacht = $_SESSION['naam'];
    $emailKlacht = $_POST['email'];
    $onderwerp = $_POST['onderwerp'];
    $comment = $_POST['comment'];
    $from = 'From: Website_Videotheek_Harmelen';
    $to = 'jellevandenbroek@gmail.com';
    $to = $emailKlacht;
    $subject = 'Ingediende Klacht';

    $body = "Klant naam: $naamklantKlacht\nE-mail: $emailKlacht\n\nOnderwerp: $onderwerp\nBericht:\n$comment";

    if (mail($to, $subject, $body, $from)) {
        echo '<h3 style=\'text-align: center;\' >Uw bericht is verzonden. Wij bekijken uw bericht zo snel mogelijk.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
        echo '<meta http-equiv="refresh" content="5" />';
    } else {
        echo '<h3 style=\'text-align: center;\' >Uw bericht is verzonden. Wij bekijken uw bericht zo snel mogelijk.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
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

            th {
                min-width: 500px;
            }
        </style>
    </head>
    <body>
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12"><h2>Klacht indienen</h2></div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="index.php?content=klantHomepage">Winkelmand</a></li>
                        <li><a href="index.php?content=reserveringen">Reserveringen</a></li>
                        <li><a href="index.php?content=klachtIndienen">Klacht indienen</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12 text-left">
                            <form role="form" action="" method="post">
                                <div class="form-group"><label class="control-label" for="email">E-mail adres<br></label>
                                    <input class="form-control" id="email" placeholder="E-mail adres" type="email" name="email" required></div>
                                <div class="form-group"><label class="control-label" for="onderwerp">Onderwerp<br></label>
                                    <input class="form-control" id="onderwerp" placeholder="Onderwerp" type="text" name="onderwerp" required></div>
                                <div class="form-group"><label class="control-label" for="comment">Klacht/Opmerking</label>
                                    <input class="form-control" id="comment" placeholder="Klacht/Opmerking" type="text" name="comment" required></div>
                                <button type="submit" class="btn btn-default" name="submit">Verzend</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br><br><br><br>
    </body>
    </html>
    <?php
}
?>
