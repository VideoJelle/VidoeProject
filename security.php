<?php
<<<<<<< HEAD
//session_start();
require_once("./classes/LoginClass.php");
require_once("./classes/SessionClass.php");
if (!isset($_SESSION['idKlant'])) {
    echo "<h3 style='text-align: center;' >U bent niet ingelogd en daarom niet bevoegd om deze pagina te bekijken. U wordt teruggestuurd naar de loginpagina.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    header("refresh:5;url=index.php?content=inloggen_Registreren");
} else {

    if (LoginClass::check_if_geblokkeerd($_SESSION['idKlant'])) {
        if (!isset($_SESSION['idKlant'])) {

            //var_dump($_SESSION);
            echo "<h3 style='text-align: center;' >U bent niet ingelogd en daarom niet bevoegd om deze pagina te bekijken. U wordt teruggestuurd naar de loginpagina.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
            header("refresh:5;url=index.php?content=inloggen_Registreren");
            exit();

        } else if (!(in_array($_SESSION['userrole'], $userrole))) {

            echo "<h3 style='text-align: center;' >U bent niet gemachtigd en daarom niet bevoegd om deze pagina te bekijken. U wordt teruggestuurd naar uw homepagina.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
            header("refresh:5;url=index.php?content=" . $_SESSION['userrole'] . "Homepage");
            exit();

        } else {

        }
    } else {
        echo "<h3 style='text-align: center;' >U bent geblokkeerd, neem contact op met: beheer@videotheekHarmelen.nl om de blokkade op te heffen</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
        header("refresh:20;url=index.php?content=logout");
        exit();
    }
=======
	//session_start();	
    require_once("./classes/LoginClass.php");
    require_once("./classes/SessionClass.php");
if (LoginClass::check_if_geblokkeerd($_SESSION['idKlant']))
	{
	if ( !isset( $_SESSION['idKlant']))
	{
		//var_dump($_SESSION);
		echo "<h3 style='text-align: center;' >U bent niet ingelogd en daarom niet bevoegd om deze pagina te bekijken. U wordt teruggestuurd naar de loginpagina.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
		header("refresh:5;url=index.php?content=inloggen_Registreren");
		exit();
	}
	else if ( !(in_array($_SESSION['userrole'], $userrole) ))
	{
		echo "<h3 style='text-align: center;' >U bent niet gemachtigd (te weinig rechten) en daarom niet bevoegd om deze pagina te bekijken. U wordt teruggestuurd naar uw homepagina.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
		header("refresh:5;url=index.php?content=".$_SESSION['userrole']."Homepage");
		exit();	
	}
    else 
    {
        
	}
}
else {
    echo "<h3 style='text-align: center;' >U bent geblokkeerd, neem contact op met: beheer@videotheekHarmelen.nl om de blokkade op te heffen</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
		header("refresh:20;url=index.php?content=logout");
		exit();
>>>>>>> d1d3ac70db9ef374de3e167b9e19b833ba7c7f1d
}
?>