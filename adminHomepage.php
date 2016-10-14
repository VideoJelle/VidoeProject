<?php
$userrole = array("admin", "eigenaar");
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
            min-width: 300px;
        }
    </style>
</head>
<body>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12"><h2>Admin Homepage</h2></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <ul class="list-group">
                    <li class="list-group-item"><a href="index.php?content=adminHomepage">Admin Homepage</a></li>
                    <li class="list-group-item"><a href="index.php?content=videoToevoegen">Video's Toevoegen</a></li>
                    <li class="list-group-item"><a href="index.php?content=adminHomepage">Video's beheren</a></li>
                    <li class="list-group-item"><a href="index.php?content=rolWijzigen">Gebruikerrol veranderen</a></li>
                    <li class="list-group-item"><a href="index.php?content=blokkeren">Gebruiker blokkeren</a></li>
                    <li class="list-group-item"><a href="index.php?content=gebruikerVerwijderen">Gebruiker verwijderen</a></li>
                    <li class="list-group-item"><a href="index.php?content=verwijderFilm">Video's verwijderen</a></li>
                </ul>
                <br><br><br><br>
            </div>
        </div>
    </div>
</div>
</body>
</html>