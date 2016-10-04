<?php
$userrole = array("root", "administrator");
require_once("./security.php");
?>

<?php
if (isset($_POST['create']))
{
	require_once("./classes/LoginClass.php");
	LoginClass::insert_film_database($_POST);
}
?>

<div class="container">
	<h2>Administratorpagina</h2>

	<h2>Nieuwe film toevoegen</h2>
	<form role="form" action='index.php?content=administratorHomepage' method='post'>
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

	<h2>Alle optredens</h2>
	<?php
	require_once("classes/LoginClass.php");
	require_once("classes/SessionClass.php");

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "melkweg";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$sql2 = "SELECT * FROM optreden";
	$result = $conn->query($sql2);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			if($row["aantaltickets"] <= 0){
				echo "<h5>id: " . $row["idticket"]. "<br> naam: " . $row["naam"]. "<br> aantal tickets: UITVERKOCHT <br> datum: " . $row["datum"]. "<br> tijd: " . $row["tijd"]. "<br> speciale evenement? =  " . $row["specialeevenement"]."<br></h5>";
			}else {
				echo "<h5>id: " . $row["idticket"]. "<br> naam: " . $row["naam"]. "<br> aantaltickets: " . $row["aantaltickets"]. "<br> datum: " . $row["datum"]. "<br> tijd: " . $row["tijd"]. "<br> speciale evenement? =  " . $row["specialeevenement"]."<br></h5>";
			}

		}
	} else {
		echo "0 results";
	}
	$conn->close();
	?>
	<br>