<?php
require_once("./classes/LoginClass.php");

if (isset($_GET['id']) && isset($_GET['email']) && isset($_GET['password'])) {

    if (LoginClass::check_if_activated($_GET['email'], $_GET['password'])) {
        $action = "index.php?content=activate&id=" . $_GET['id'] . "&email=" . $_GET['email'] . "&password=" . $_GET['password'];

        if (LoginClass::check_if_email_password_exists($_GET['email'], $_GET['password'], 'no')) {
            if (isset($_POST['submit'])) {
                // 1. Check of de twee ingevoerde passwords correct zijn.
                if (!strcmp($_POST['password_1'], $_POST['password_2'])) {
                    // 2. Activeer het account en update het oude password naar het nieuwe password.
                    LoginClass::activate_account_by_id($_GET['id']);
                    LoginClass::update_password($_POST['id'], $_POST['password_1']);
                } else {
                    echo "<h2>passwords komen niet overeen, probeer het nog een keer.</h2>";
                    header("refresh:4;url=" . $action);
                }
            } else {
                echo "<h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Uw account wordt geactiveerd.<br>
						  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Kies een nieuw password</h3><br>";
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
                            <div class="col-md-6"><h3>Wachtwoord Instellen</h3></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <form role="form" action="<?php echo $action; ?>" method='post'>
                                    <div class="form-group"><label class="control-label" for="password_1">Typ hier uw nieuwe wachtwoord:<br></label><input class="form-control"
                                                                                                                                                           id="InputPassword1"
                                                                                                                                                           name="password_1"
                                                                                                                                                           placeholder="Voer wachtwoord in"
                                                                                                                                                           type="password"></div>
                                    <div class="form-group"><label class="control-label" for="InputPassword1">Typ nogmaals uw wachtwoord ter controle:</label><input
                                            class="form-control" id="InputPassword2"
                                            name="password_2" placeholder="Voer nogmaals wachtwoord in"
                                            type="password"></div>
                                    <button type="submit" name="submit" class="btn btn-default">Verstuur</button>
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
        } else {
            echo "<h2>U heeft geen rechten op deze pagina. Uw email/password combi is niet correct of uw account is al geactiveerd. U wordt doorgestuurd naar de registratiepagina</h2><br>";
            header("refresh:4;url=index.php?content=inloggen_Registreren");
        }
    } else {
        echo "<h2>Uw account is all geactiveerd of uw email/password combi is niet correct u heeft daarom geen rechten op deze pagina. U wordt doorgestuurd naar de registratiepagina</h2><br>";
        header("refresh:4;url=index.php?content=inloggen_Registreren");
    }
} else {
    echo "<h2>Uw url is niet correct en daarom heeft u geen rechten op deze pagina. U wordt doorgestuurd naar de registratiepagina</h2><br>";
    header("refresh:4;url=index.php?content=inloggen_Registreren");
}
?>


<!--								<div class="container">-->
<!--								<form  action="--><?php //echo $action;
?><!--" method='post' >-->
<!--								<div class="form-group">-->
<!--								  <label for="password_1">Type hier uw nieuwe wachtwoord:</label>-->
<!--								  <input type="password" class="form-control" name="password_1" placeholder="Enter wachtwoord">-->
<!--								</div>-->
<!--								<div class="form-group">-->
<!--								  <label for="password_2">Type nogmaals uw wachtwoord (controle):</label>-->
<!--								  <input type="password" class="form-control" name="password_2" placeholder="Enter wachtwoord">-->
<!--								</div>-->
<!--									<input type='hidden' name='id' value='--><?php //echo $_GET['id'];
?><!--'/>-->
<!--								<button type="submit" name="submit" class="btn btn-default">Submit</button>-->
<!--							  </form>-->
<!--							</div>-->