<?php
	if (isset($_POST['submit']))
	{
		require_once("./classes/Loginclass.php");
		if (LoginClass::check_if_email_exists($_POST['email']))
		{
			//Zo ja, geef een melding dat het emailadres bestaat en stuur
			//door naar register_form.php
			echo "Het door u gebruikte emailadres is al in gebruik.<br>
				  Gebruik een ander emailadres. U wordt doorgestuurd naar<br>
				  het registratieformulier";
			header("refresh:5;url=index.php?content=register_form");
		}
		else
		{
			LoginClass::insert_into_database($_POST);
		}
	}
	else
	{
?>

<!DOCTYPE html>
<html>
    <head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>    
    <link rel="stylesheet" type="text/css" href="style.css">

<div class="container">
  <h2>Registreren</h2>
  <form role="form">
    <div class="form-group">
      <label for="voornaam">Voornaam:</label>
      <input type="text" class="form-control" id="voornaam" placeholder="Enter voornaam">
    </div>
    <div class="form-group">
      <label for="tussenvoegsel">Tussenvoegsel:</label>
      <input type="text" class="form-control" id="tussenvoegsel" placeholder="Enter tussenvoegsel">
    </div>
    <div class="form-group">
      <label for="achternaam">Achternaam:</label>
      <input type="text" class="form-control" id="achternaam" placeholder="Enter achternaam">
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email">
    </div>
    <div class="form-group">
      <label for="pwd">Wachtwoord:</label>
      <input type="wachtwoord" class="form-control" id="ww" placeholder="Enter wachtwoord">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>

</body>
</html>
<?php
	}
?>