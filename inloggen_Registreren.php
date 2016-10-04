<?php
if (isset($_POST['submitRegister'])) {
    require_once("./classes/LoginClass.php");

    if (LoginClass::check_if_email_exists($_POST['email'])) {
        //Zo ja, geef een melding dat het emailadres bestaat en stuur
        //door naar register_form.php
        echo "Het door u gebruikte emailadres is al in gebruik.<br>
				  Gebruik een ander emailadres. U wordt doorgestuurd naar<br>
				  het registratieformulier";
        header("refresh:5;url=index.php?content=inloggen_Registreren");
    } else {
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
                        <div class="form-group"><label class="control-label" for="InputVoornaam">Voornaam<br></label><input class="form-control" id="InputVoornaam"
                                                                                                                                   name="firstname" placeholder="Voornaam"
                                                                                                                                   type="text"></div>
                        <div class="form-group"><label class="control-label" for="InputTussenvoegsel">Tussenvoegsel<br></label><input class="form-control"
                                                                                                                                             id="InputTussenvoegsel"
                                                                                                                                             name="infix"
                                                                                                                                             placeholder="Tussenvoegsel"
                                                                                                                                             type="text"></div>
                        <div class="form-group"><label class="control-label" for="InputAchternaam">Achternaam<br></label><input class="form-control"
                                                                                                                                       id="InputAchternaam" name="lastname"
                                                                                                                                       placeholder="Achternaam" type="text"></div>
                        <div class="form-group"><label class="control-label" for="InputEmail1">E-mail<br></label><input class="form-control" id="InputEmail1"
                                                                                                                               name="email" placeholder="E-mail" type="email"></div>
<!--                        <div class="form-group"><label class="control-label" for="InputPassword1">Wachtwoord</label><input class="form-control" id="InputPassword1"-->
<!--                                                                                                                                  name="email" placeholder="Wachtwoord"-->
<!--                                                                                                                                  type="password"></div>-->
<!--                        <div class="form-group"><label class="control-label" for="InputPassword2">Herhaal wachtwoord</label><input class="form-control"-->
<!--                                                                                                                                          id="InputPassword2"-->
<!--                                                                                                                                          placeholder="Herhaal wachtwoord"-->
<!--                                                                                                                                          type="password"></div>-->
                        <button type="submit" name="submitRegister" class="btn btn-default">Verstuur<br></button>
                    </form>
                </div>
                <div class="col-md-6">
                    <form role="form" action='index.php?content=checklogin' method='post'>
                        <div class="form-group"><label class="control-label" for="InputEmail1">E-mail<br></label><input class="form-control" id="InputEmail1"
                                                                                                                               name="email" placeholder="E-mail" type="email"></div>
                        <div class="form-group"><label class="control-label" for="InputPassword1">Wachtwoord</label><input class="form-control" id="InputPassword1"
                                                                                                                                  name="password" placeholder="Wachtwoord"
                                                                                                                                  type="password"></div>
                        <button type="submit" name="submitLogin" class="btn btn-default">Verstuur</button>
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