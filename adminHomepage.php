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
            <div class="row">
                <div class="col-md-12"><h2>Administrator Pagina</h2></div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="index.php?content=adminHomepage">Video's beheren</a></li>
                        <li><a href="index.php?content=rolWijzigen">Gebruikerrol veranderen/blokkeren</a></li>
                        <li><a href="index.php?content=gebruikerVerwijderen">Gebruiker verwijderen</a></li>
                    </ul>
                </div>
            </div>
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
    </div>
</div>

</body>
</html>