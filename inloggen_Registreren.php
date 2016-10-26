<?php
if (isset($_POST['submitRegister'])) {
    require_once("./classes/LoginClass.php");

    if (LoginClass::check_if_email_exists($_POST['email'])) {
        //Zo ja, geef een melding dat het emailadres bestaat en stuur
        //door naar register_form.php
        echo "<h3 style='text-align: center;' >Het door u gebruikte emailadres is al in gebruik. Gebruik een ander emailadres. <br>U wordt doorgestuurd naar het registratieformulier</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
        header("refresh:5;url=index.php?content=inloggen_Registreren");
    } else {
        echo "<h3 style='text-align: center;' >Uw gegevens zijn verwerkt.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
        header("refresh:3;url=index.php?content=inloggen_Registreren");
        LoginClass::insert_into_database($_POST);
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
        <link href="http://pingendo.github.io/pingendo-bootstrap/themes/default/bootstrap.css" rel="stylesheet" type="text/css">
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
            <div class="row">
                <div class="col-md-6"><h3>Registreren</h3></div>
                <div class="col-md-6"><h3>Inloggen</h3></div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <form role="form" action='index.php?content=inloggen_Registreren' method='post'>
                        <div class="form-group"><label class="control-label" for="InputNnaam">Volledige naam<br></label><input class="form-control"
                                                                                                                            id="InputNaam"
                                                                                                                            name="naam"
                                                                                                                            placeholder="Naam"
                                                                                                                            type="text"></div>
                        <div class="form-group"><label class="control-label" for="InputAdres">Adres<br></label><input class="form-control"
                                                                                                                      id="InputAdres"
                                                                                                                      name="adres"
                                                                                                                      placeholder="Adres"
                                                                                                                      type="text"></div>
                        <div class="form-group"><label class="control-label" for="InputWoonplaats">Woonplaats<br></label><input class="form-control"
                                                                                                                                id="InputWoonplaats"
                                                                                                                                name="woonplaats"
                                                                                                                                placeholder="Woonplaats"
                                                                                                                                type="text"></div>
                        <div class="form-group"><label class="control-label" for="InputEmail1">E-mail<br></label><input class="form-control"
                                                                                                                        id="InputEmail1"
                                                                                                                        name="email"
                                                                                                                        placeholder="E-mail"
                                                                                                                        type="email"></div>

                        <button type="submit" name="submitRegister" class="btn btn-primary">Verstuur<br></button>

                    </form>
                </div>
                <div class="col-md-6">
                    <form role="form" action='index.php?content=checklogin' method='post'>
                        <div class="form-group"><label class="control-label" for="InputEmail1">E-mail<br></label><input class="form-control" id="InputEmail1"
                                                                                                                        name="email" placeholder="E-mail" type="email"></div>
                        <div class="form-group"><label class="control-label" for="InputPassword1">Wachtwoord</label><input class="form-control" id="InputPassword1"
                                                                                                                           name="password" placeholder="Wachtwoord"
                                                                                                                           type="password"></div>

                        <button type="submit" name="submitLogin" class="btn btn-primary">Verstuur</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12"></div>
            </div>
        </div>
    </div>
    </body>
    </html>
    <?php
}
?>